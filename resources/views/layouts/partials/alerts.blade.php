@if (session()->has('success'))
<div class="row" style="margin:0 auto;">
	<div class="alert alert-dismissible alert-success alert-has-icon" role="alert" style="width:100%">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<div class="alert-icon"><i class="fa fa-check"></i></div>
		<div class="alert-body">
			<div class="alert-title">{{ session()->get('success') }}</div>
		</div>
	</div>
</div>
@endif

@if (session()->has('info'))
<div class="row" style="margin:0 auto;">
	<div class="alert alert-dismissible alert-info" role="alert" style="width:100%">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		{{ session()->get('info') }}
	</div>
</div>
@endif

@if (session()->has('warning'))
<div class="row" style="margin:0 auto;">
	<div class="alert alert-dismissible alert-warning" role="alert" style="width:100%">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		{{ session()->get('warning') }}
	</div>
</div>
@endif

@if (session()->has('danger'))
<div class="row" style="margin:0 auto;">
	<div class="alert alert-dismissible alert-danger" role="alert" style="width:100%">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		{{ session()->get('danger') }}
	</div>
</div>
@endif

