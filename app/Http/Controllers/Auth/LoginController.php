<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/events';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
      $this->validate($request,[
          'email'=>'required|email',
          'password'=>'required'
      ]);
      $check_stall_staff = User::where('email',$request->email)->where('role_id',3)->first();
      if($check_stall_staff){
        return back()->withInput($request->only('email', 'remember'))
            ->withErrors([
            'email' => 'Incorrect email address or password',
        ]);
      }
      if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){
          return redirect('events');
      } else {
          return back()->withInput($request->only('email', 'remember'))
              ->withErrors([
              'email' => 'Incorrect email address or password',
          ]);
      }
    }
}
