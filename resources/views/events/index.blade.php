@extends('layouts.app')

@section('title')
Events
@endsection

@section('content')
@include('layouts.partials.sidebar', array('active' => 'events'))

 <!-- Main Content -->
<div class="main-content">
  <section class="section">
	<div class="section-header">
	  <h1><i class="far fa-calendar"></i> Events</h1>
	  <div class="section-header-breadcrumb">
	  	@if(Auth::user()->role_id==1)
		<a href="javascript:void(0)" class="btn btn-primary btn-sm add-event-btn float-right" rel="tooltip" title="Edit" data-container="body"><i class="fa fa-plus"></i> Add New Event</a>
		@endif
	  </div>
	</div>

	@include('layouts.partials.alerts')
	
	<div class="section-body">
		<div class="card">
			<div class="card-body">
				<div class="filter-table-box">
					<div class="filter_control" style="width: 100%;">
						<div class="filter_title">Company:</div>
						<select id="vendor_id_filter" class="filter form-control form-control-sm" style="display:inline-block;width:200px;">
							<option value="">- All -</option>
							@if(!empty($companies))
								@foreach($companies as $company)
								<option value="{{ $company->id }}">{{ $company->name }}</option>
								@endforeach
							@endif
						</select>

						<div class="filter_title">Status:</div>
						<select id="status_filter" class="filter form-control form-control-sm" style="display:inline-block;width:200px;">
							<option value="">- All -</option>
							<option value="pending">pending</option>
							<option value="approved">approved</option>
							<option value="rejected">rejected</option>
						</select>
						
					</div>
				</div>
				<br />
				<div class="table-responsive">
					<table class="datatable-narrow table table-sm table-striped" id="events-table">
						<thead>
							<tr>
								<th>Event Name</th>
								<th>Vendor Name</th>
								<th>Confirmed Date</th>
								<th>Status</th>
								<th>Date Created</th>
								<th class="text-center no-sort" style="width:65px;"></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="modal fade" id="modal-add-event"  tabindex="-1" role="dialog" aria-labelledby="modal-add-event" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<form id="form-add-event" class="form-horizontal" method="GET" action="{{ url('event') }}">
					<div class="modal-header bg-whitesmoke">
						<h4 class="modal-title" id="myLargeModalLabel">Add New event</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{!! csrf_field() !!}
						{!! method_field('POST') !!}
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Event name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="name" >
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Vendor name</label>
							<div class="col-sm-9">
								<select name="vendor_id" class="form-control">
									@if(!empty($companies))
										@foreach($companies as $company)
										<option value="{{ $company->id }}">{{ $company->name }}</option>
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 1</label>
							<div class="col-sm-9">
								<input class="form-control datepicker" type="text" name="proposed_date1" style="width:150px;">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 2</label>
							<div class="col-sm-9">
								<input class="form-control datepicker" type="text" name="proposed_date2" style="width:150px;">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 3</label>
							<div class="col-sm-9">
								<input class="form-control datepicker" type="text" name="proposed_date3" style="width:150px;">
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Postal Code</label>
							<div class="col-sm-9">
								<input class="form-control" type="number" name="proposed_postal_code" style="width:150px;">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Street Name</label>
							<div class="col-sm-9">
								<input class="form-control" type="text" name="proposed_street_name" >
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke">
						<div class="form-group row">
							<div class="col-sm-6 offset-sm-3">
								<button type="submit" class="btn btn-primary new-event">Add</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal-event-confirmation"  tabindex="-1" role="dialog" aria-labelledby="modal-add-event" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<form id="form-confirm-event" class="form-horizontal" method="GET" action="{{ url('event_confirmation') }}">
					<div class="modal-header bg-whitesmoke">
						<h4 class="modal-title" id="myLargeModalLabel">Event Detail</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{!! csrf_field() !!}
						{!! method_field('PUT') !!}
						<style>
							.show_value{
								margin-top: 6px;
								float: left;
							}
							.form-group{
								margin-bottom:2px;
							}
							hr{
								margin:2px;
							}
						</style>
						<input type="hidden" name="id" />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Event name</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_event_name"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Vendor name</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_vendor_name"></span>
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 1</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_proposed_date1"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 2</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_proposed_date2"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Proposed Date 3</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_proposed_date3"></span>
							</div>
						</div>
						<hr />
						
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Confirmed Date</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_confirmed_date"></span>
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Postal Code</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_proposed_postal_code"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Street Name</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_proposed_street_name"></span>
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Created By</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_created_user"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Created Date</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_created_at"></span>
							</div>
						</div>
						<hr />
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_status"></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<span class="show_value" id="show_remarks"></span>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke">
						<div class="form-group row">
							<div class="col-sm-6 offset-sm-3">
								@if(Auth::user()->role_id==2)
								<button type="button" class="btn btn-primary approve-event">Approve</button>
								<button type="button" class="btn btn-info reject-event" >Reject</button>
								@endif
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-approve-event"  tabindex="-1" role="dialog" aria-labelledby="modal-add-event" aria-hidden="true">
		<div class="modal-dialog modal-md modal-dialog-centered" role="document">
			<div class="modal-content">
				<form id="form-approve-event" class="form-horizontal" method="GET" action="{{ url('event_confirmation') }}">
					<div class="modal-header bg-whitesmoke">
						<h4 class="modal-title" id="myLargeModalLabel">Approve Event</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{!! csrf_field() !!}
						{!! method_field('PUT') !!}
						<input type="hidden" class="event_id" name="id" />
						<input type="hidden" name="status" value="approved" />
						
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Confirmed Date</label>
							<div class="col-sm-8">
								<select name="confirmed_date_index" id="confirmed_date_index" class="form-control"></select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Remarks</label>
							<div class="col-sm-8">
								<textarea name="remarks" class="form-control"></textarea>
							</div>
						</div>
						<hr />
					</div>
					<div class="modal-footer bg-whitesmoke">
						<div class="form-group row">
							<div class="col-sm-6 offset-sm-4">
								<button type="submit" class="btn btn-primary" >Submit</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="modal fade" id="modal-reject-event"  tabindex="-1" role="dialog" aria-labelledby="modal-add-event" aria-hidden="true">
		<div class="modal-dialog modal-md modal-dialog-centered" role="document">
			<div class="modal-content">
				<form id="form-reject-event" class="form-horizontal" method="GET" action="{{ url('event_confirmation') }}">
					<div class="modal-header bg-whitesmoke">
						<h4 class="modal-title" id="myLargeModalLabel">Reject Event</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						{!! csrf_field() !!}
						{!! method_field('PUT') !!}
						<input type="hidden" class="event_id" name="id" />
						<input type="hidden" name="status" value="rejected" />
					
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Remarks</label>
							<div class="col-sm-9">
								<textarea name="remarks" class="form-control"></textarea>
							</div>
						</div>
						<hr />
					</div>
					<div class="modal-footer bg-whitesmoke">
						<div class="form-group row">
							<div class="col-sm-6 offset-sm-3">
								<button type="submit" class="btn btn-primary" >Submit</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
  </section>
</div>

<style>
.select2-container{width: 100%!important;}
</style>

<script>
	$(document).ready(function(){
		
		$('.filter').change(function() {
			oTable.ajax.reload();
		});
		$('.datepicker').val('');
		
		var oTable = $('#events-table').DataTable({
			processing: true,
			serverSide: true,
			scrollX: true,
			scrollCollapse: true,
			order: [[ 4, "desc" ]],
			lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
			ajax: {
				'url': '{{ url('datatable/events') }}',
				'data': function ( d ) {
					d.vendor_id = $('#vendor_id_filter').val();
					d.status = $('#status_filter').val();
				}
			},
			dom: 'Blfrtip',
			buttons: [
				{
				   extend: 'pdfHtml5',
				   text: '<i class="far fa-file-pdf"></i>',
				   exportOptions: {
					  modifier: {
						 page: 'current'
					  }
				   },
				   header: true,
				   title: 'event {{ date("Y-m-d H:i:s") }}',
				   orientation: 'landscape',
				   pageSize: 'A3',
				   customize: function(doc) {
					  doc.defaultStyle.fontSize = 10;
					  doc.styles.tableHeader.fontSize = 10;
				   }
				},
				{
				   extend: 'excel',
				   text: '<i class="far fa-file-excel"></i>',
				   exportOptions: {
					  modifier: {
						 page: 'current'
					  }
				   },
				   header: true,
				   title: 'event {{ date("Y-m-d H:i:s") }}',
				   orientation: 'landscape',
				},
				{
				   extend: 'print',
				   text: '<i class="fas fa-print"></i>',
				   exportOptions: {
					  modifier: {
						 page: 'current'
					  }
				   },
				   header: true,
				   title: 'event {{ date("Y-m-d H:i:s") }}',
				   customize: function(win)
						{

							var last = null;
							var current = null;
							var bod = [];

							var css = '@page { size: A4 landscape; }',
								head = win.document.head || win.document.getElementsByTagName('head')[0],
								style = win.document.createElement('style');

							style.type = 'text/css';
							style.media = 'print';

							if (style.styleSheet)
							{
							  style.styleSheet.cssText = css;
							}
							else
							{
							  style.appendChild(win.document.createTextNode(css));
							}

							head.appendChild(style);

							$(win.document.body)
								.css( 'font-size', '10pt!important' );
							$(win.document.body).find( 'table' )
								.addClass( 'compact' )
								.css( 'font-size', 'inherit' );
						}
				}
			],
			columns: [
				{ data: 'name', name: 'name' },
				{ data: 'vendor_name', name: 'vendor_name' },
				{ data: 'confirmed_date', name: 'confirmed_date' },
				{ data: 'status', name: 'status' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'action', name: 'action' }
			]
		});
		oTable.on( 'draw', function () {
			$('.show-event').on('click', function (e) {
				e.preventDefault();
				var id  = $(this).data('event');
				var action = "{{ url('event') }}/"+id;
				var token  = $(this).data('token');
				$("#page-loader").modal('show');
				$.ajax({
					type: 'GET',
					url: action,
					error: function (msg) {
						$("#page-loader").modal('hide');
						alert(msg.responseJSON[0]);
					},
					success: function(response){
						$("#page-loader").modal('hide');
						$('#modal-event-confirmation').appendTo("body").modal('show');
						$("#show_event_name").html(response['name']);
						$("#show_vendor_name").html(response['vendor_name']);
						$("#show_proposed_date1").html(response['proposed_date1']);
						$("#show_proposed_date2").html(response['proposed_date2']);
						$("#show_proposed_date3").html(response['proposed_date3']);
						$("#show_confirmed_date").html(response['confirmed_date']);
						$("#show_proposed_postal_code").html(response['proposed_postal_code']);
						$("#show_proposed_street_name").html(response['proposed_street_name']);
						$("#show_created_user").html(response['created_user']);
						$("#show_created_at").html(response['created_at']);
						$("#show_status").html(response['status']);
						$("#show_remarks").html(response['remarks']);
						$(".event_id").val(response['id']);

						$("#confirmed_date_index").html('');
						if(response['proposed_date1']!=null){
							$("#confirmed_date_index").append('<option value="1">'+response['proposed_date1']+'</option>');
						}
						if(response['proposed_date2']!=null){
							$("#confirmed_date_index").append('<option value="2">'+response['proposed_date2']+'</option>');
						}
						if(response['proposed_date3']!=null){
							$("#confirmed_date_index").append('<option value="3">'+response['proposed_date3']+'</option>');
						}
						@if(Auth::user()->role_id==2)
							if(response['status']!="pending"){
								$('.approve-event').hide();
								$('.reject-event').hide();
							}
						@endif
					}
				});
			});
		});
		
		$('.add-event-btn').click(function(){
			$('#modal-add-event').appendTo("body").modal('show');
		});

		$('.approve-event').click(function(){
			$('#modal-approve-event').appendTo("body").modal('show');
		});

		$('.reject-event').click(function(){
			$('#modal-reject-event').appendTo("body").modal('show');
		});
		
		$('#form-add-event').on('submit', function (e) {
			e.preventDefault();
			var form	= $(this);
			var action	= form.attr('action');
			$("#page-loader").modal('show');
			$.ajax({
				type: 'POST',
				url: action,
				data: form.serialize(),
				error: function (msg) {
					$("#page-loader").modal('hide');
					form.find('.form-group').removeClass('has-error');
					form.find('.help-block').remove();
					$.each(['name','vendor_id', 'proposed_date1'], function (key, value) {
						if (value in msg.responseJSON.errors) {
							group = form.find('[name="' + value + '"]').closest('.form-group');
							group.addClass('has-error');
							group.find('[name="' + value + '"]').after('<span class="help-block">' + msg.responseJSON.errors[value][0] + '</span>');
						}
					});
				},
				success: function () {
					$("#page-loader").modal('hide');
					window.location.href = window.location;
				}
			});
		});

		$('#form-approve-event').on('submit', function (e) {
			e.preventDefault();
			var form	= $(this);
			var action	= form.attr('action');
			$("#page-loader").modal('show');
			$.ajax({
				type: 'POST',
				url: action,
				data: form.serialize(),
				error: function (msg) {
					$("#page-loader").modal('hide');
					form.find('.form-group').removeClass('has-error');
					form.find('.help-block').remove();
					$.each(['confirmed_date_index', 'status'], function (key, value) {
						if (value in msg.responseJSON.errors) {
							group = form.find('[name="' + value + '"]').closest('.form-group');
							group.addClass('has-error');
							group.find('[name="' + value + '"]').after('<span class="help-block">' + msg.responseJSON.errors[value][0] + '</span>');
						}
					});
				},
				success: function () {
					$("#page-loader").modal('hide');
					window.location.href = window.location;
				}
			});
		});

		$('#form-reject-event').on('submit', function (e) {
			e.preventDefault();
			var form	= $(this);
			var action	= form.attr('action');
			$("#page-loader").modal('show');
			$.ajax({
				type: 'POST',
				url: action,
				data: form.serialize(),
				error: function (msg) {
					$("#page-loader").modal('hide');
					form.find('.form-group').removeClass('has-error');
					form.find('.help-block').remove();
					$.each(['confirmed_date_index', 'status'], function (key, value) {
						if (value in msg.responseJSON.errors) {
							group = form.find('[name="' + value + '"]').closest('.form-group');
							group.addClass('has-error');
							group.find('[name="' + value + '"]').after('<span class="help-block">' + msg.responseJSON.errors[value][0] + '</span>');
						}
					});
				},
				success: function () {
					$("#page-loader").modal('hide');
					window.location.href = window.location;
				}
			});
		});
	});
</script>

@endsection