@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col-md-12 mb-2 text-right">
		<h2 class="card-title d-none">{{ _lang('User List') }}</h2>
		<a class="btn btn-primary btn-sm ajax-modal" href="{{ route('users.create') }}" data-title="{{ _lang('Add New') }}">
			<i class="fas fa-plus mr-1"></i>
			{{ _lang('Add New') }}
		</a>
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
								@foreach (App\Models\AppModel::where('status', 1)->get() as $data)
								<option value="{{ $data->app_unique_id }}" data-image="{{ asset($data->app_logo) }}">
									{{ $data->app_name }} - {{ $data->app_unique_id }}
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
							
							<th>{{ _lang('Image') }}</th>
        					<th>{{ _lang('Name') }}</th>
        					<th>{{ _lang('Email') }}</th>
        					<th>{{ _lang('Subscription') }}</th>
        					<th>{{ _lang('Status') }}</th>

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
			window.location.href = _url + "/users?id=" + app_unique_id;
		}else{
			window.location.href = _url + "/users";
		}
	});

	$('#data-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _url + "/users?id={{ $app_unique_id }}",
		"columns" : [
			
			{ data : "image", name : "image", className : "image" },
        	{ data : "name", name : "name", className : "name" },
        	{ data : "email", name : "email", className : "email" },
        	{ data : "subscription.name", name : "subscription.name", className : "subscription.name" },
        	{ data : "status", name : "status", className : "status" },
			{ data : "action", name : "action", orderable : false, searchable : false, className : "text-center" }
			
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,	
		"ordering": false
	});
</script>
@endsection