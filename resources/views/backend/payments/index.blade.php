@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 mb-2 text-right">
		<h2 class="card-title d-none">{{ _lang('Payments List') }}</h2>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-6 m-auto">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('App') }}</label>
							<select class="form-control select2-image" name="app_unique_id" data-selected="{{ $app_unique_id }}" required>
								<option value="">{{ _lang('Select One') }}</option>
								@foreach (get_apps() as $app)
								<option value="{{ $app->app_unique_id }}" data-image="{{ asset($app->app_logo) }}">
									{{ $app->app_name }} - {{ $app->app_unique_id }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id="data-table">
					<thead>
						<tr>
							
        					<th>{{ _lang('User') }}</th>
        					<th>{{ _lang('Subscription') }}</th>
        					<th>{{ _lang('Amount') }}</th>
        					<th>{{ _lang('Platform') }}</th>

							<th class="text-center">{{ _lang('Action') }}</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js-script')
<script type="text/javascript">
	$(document).on("change", "select[name='app_unique_id']", function () {
		var app_unique_id = $(this).val();
		if (app_unique_id != '') {
			window.location.href = _url + "/payments?id=" + app_unique_id;
		}else{
			window.location.href = _url + "/payments";
		}
	});

	$('#data-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _url + "/payments?id={{ $app_unique_id }}",
		"columns" : [
			
        	{ data : "user.name", name : "user.name", className : "name" },
        	{ data : "subscription.name", name : "subscription.name", className : "name" },
        	{ data : "amount", name : "amount", className : "amount" },
        	{ data : "platform", name : "platform", className : "platform" },
			{ data : "action", name : "action", orderable : false, searchable : false, className : "text-center" }
			
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,	
		"ordering": false
	});
</script>
@endsection