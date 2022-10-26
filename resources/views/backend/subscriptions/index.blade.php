@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 mb-2 text-right">
		<h2 class="card-title d-none">{{ _lang('Subscriptions List') }}</h2>
		<a class="btn btn-primary btn-sm" href="{{ route('subscriptions.create') }}" >
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
							
        					<th>{{ _lang('Name') }}</th>
        					<th>{{ _lang('Duration') }}</th>
        					<th>{{ _lang('Platform') }}</th>
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
			window.location.href = _url + "/subscriptions?id=" + app_unique_id;
		}else{
			window.location.href = _url + "/subscriptions";
		}
	});

	$('#data-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _url + "/subscriptions?id={{ $app_unique_id }}",
		"columns" : [
			
        	{ data : "name", name : "name", className : "name" },
        	{ data : "duration", name : "duration", className : "duration" },
        	{ data : "platform", name : "platform", className : "platform" },
        	{ data : "status", name : "status", className : "status" },
			{ data : "action", name : "action", orderable : false, searchable : false, className : "text-center" }
			
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,	
		"ordering": false
	});
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
      $("#data-table tbody").sortable({
          update: function(event, ui)
            {
                var subscriptions = [];
                var subscriptionOrder = 1;
                $("#data-table tbody > tr").each(function(){
                    var id = $(this).data('id');
                    subscriptions.push( { id: id, position: subscriptionOrder });
                    subscriptionOrder++;
                });
                
                var subscriptions = JSON.stringify( subscriptions );

                $.ajax({
                    method: "POST",
                    url: '{{ url("subscriptions/reorder") }}',
                    data:  { _token: $('[name=csrf-token]').attr('content'), subscriptions},
                    cache: false,
                    success: function(data){
                       
                        toast('success', data['message']);
                        
                    }
                });
            }
      	});
    });
</script>
@endsection