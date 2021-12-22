<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;

use App\Models\Company;
use App\Models\Event;

use Flash;
use Auth;
use Gate;
use Hash;
use Yajra\Datatables\Datatables;

class EventController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		if(Auth::user()->role_id==1){
			$companies=Company::all()->sortBy('name');
		} else {
			$companies=Company::where('id',Auth::user()->company_id)->get();
		}
		return view('events.index')->withCompanies($companies);
	}

	public function create(Request $request)
	{
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'vendor_id' => 'required',
			'proposed_date1' => 'required',
		]);
		$event = new Event;
		$event->name					= $request->input('name');
		$event->vendor_id				= $request->input('vendor_id');
		$event->proposed_date1			= $request->input('proposed_date1');
		$event->proposed_date2			= $request->input('proposed_date2');
		$event->proposed_date3			= $request->input('proposed_date3');
		$event->proposed_postal_code	= $request->input('proposed_postal_code');
		$event->proposed_street_name	= $request->input('proposed_street_name');
		$event->created_by				= Auth::user()->id;
		$event->status					= 'pending';
		$event->save();

		if ($request->ajax()) {
			$request->session()->flash('success', 'Event added successfully');
		} else {
			return redirect()->route('events.index')->with('success', 'Event added successfully');
		}
	}

	public function show($id)
	{
		$event = Event::find($id);
		if(!isset($event)){
			return response()->json('Event is not found.', 422);
		}
		$format['id']=$event->id;
		$format['vendor_name']=isset($event->company->name)?$event->company->name:'';
		$format['name']=$event->name;
		$format['created_by']=$event->created_by;
		$format['created_user']=isset($event->created_user->name)?$event->created_user->name:'';
		$format['proposed_date1']=$event->proposed_date1;
		$format['proposed_date2']=$event->proposed_date2;
		$format['proposed_date3']=$event->proposed_date3;
		$format['proposed_postal_code']=$event->proposed_postal_code;
		$format['proposed_street_name']=$event->proposed_street_name;
		$format['confirmed_date_index']=$event->confirmed_date_index;
		$format['confirmed_date']='';
		if($event->confirmed_date_index!=""){
			$format['confirmed_date']=$event->{'proposed_date'.$event->confirmed_date_index};
		}
		$format['confirmed_by']=$event->created_by;
		$format['confirmed_user']=isset($event->confirmed_user->name)?$event->confirmed_user->name:'';
		$format['remarks']=$event->remarks;
		$format['status']=$event->status;
		$format['created_at']=$event->created_at;
		return response()->json($format);
	}

	public function edit($id)
	{
		
	}
	
	public function event_confirmation(Request $request)
	{
		$event = Event::find($request->input('id'));
		if(!isset($event)){
			return response()->json('Event is not found.', 422);
		}
		if($request->input('status')=="approved"){
			$this->validate($request, [
				'status' => 'required',
				'confirmed_date_index' => 'required'
			]);
		} else {
			$this->validate($request, [
				'status' => 'required'
			]);
		}
		$event->status					= $request->input('status');
		$event->confirmed_date_index	= $request->input('confirmed_date_index');
		$event->remarks					= $request->input('remarks');
		$event->confirmed_by			= Auth::user()->id;
		$event->save();

		if ($request->ajax()) {
			$request->session()->flash('success', 'Event '.$request->input('status').' successfully');
		} else {
			return redirect()->back()->with('success', 'Event '.$request->input('status').' successfully');
		}
	}
	
	public function destroy(Request $request, $id)
	{
		$event = Event::find($id);
		if(!isset($event)){
			return response()->json('Event is not found.', 422);
		}
		Event::destroy($id);
		if ($request->ajax()) {
			$request->session()->flash('success', 'Event deleted successfully');
		} else {
			return redirect()->route('events.index')->with('success', 'Event deleted successfully');
		}
	}
	
	public function events_table()
	{
		$events= Event::select('*');
		if(isset($_GET['vendor_id'])){
			$vendor_id=$_GET['vendor_id'];
			if($vendor_id!=""){
				$events=$events->where('vendor_id', $vendor_id);
			}
		}
		if(isset($_GET['status'])){
			$status=$_GET['status'];
			if($status!=""){
				$events=$events->where('status', $status);
			}
		}
		//company hr can only see event created by him/her
		if(Auth::user()->role_id==1){
			$events=$events->where('created_by', Auth::user()->id);
		}

		//vendor can only see event for his/her own company
		if(Auth::user()->role_id==2){
			$events=$events->where('vendor_id', Auth::user()->company_id);
		}
		$events = $events->get();
		return DataTables::of($events)
			->addColumn('vendor_name', function ($events) {
				return (isset($events->company->name))?$events->company->name:"";
			  })
			->addColumn('created_user', function ($events) {
				return (isset($events->created_user->name))?$events->created_user->name:"";
			})
			->addColumn('confirmed_date', function ($events) {
				if($events->status=="approved" && $events->confirmed_date_index!=null){
					return $events->{"proposed_date".$events->confirmed_date_index};
				}
				$proposed_date=$events->proposed_date1;
				if($events->proposed_date2!=""){ $proposed_date=$proposed_date.", ".$events->proposed_date2;}
				if($events->proposed_date3!=""){ $proposed_date=$proposed_date.", ".$events->proposed_date3;}
				return $proposed_date;
			})
			->addColumn('action',
				function ($events) {
					return '
					<div class="btn-group btn-group-xs">
						<a data-event="'.$events->id.'" class="btn btn-primary btn-sm show-event" rel="tooltip" title="Show" data-container="body" 
						data-token="'.csrf_token().'"><i class="fa fa-search"></i> View</a>
					</div>
					';
            })
            ->make(true);
	}
}
