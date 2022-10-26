@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 mb-2 text-right">
		<h4 class="card-title d-none">{{ _lang('Apps List') }}</h4>
		<a class="btn btn-primary btn-sm" href="{{ route('apps.create') }}" >
			<i class="fas fa-plus mr-1"></i>
			{{ _lang('Add New') }}
		</a>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id="data-table">
					<thead>
						<tr>
							
							<th>{{ _lang('App Logo') }}</th>
        					<th>{{ _lang('App') }}</th>
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
	$('#data-table').DataTable({
		processing: true,
		serverSide: true,
		ajax: _url + "/apps",
		"columns" : [
			
			{ data : "app_logo", name : "app_logo" },
        	{ data : "_app", name : "_app" },
            { data : "status", name : "status", className : "status" },
			{ data : "action", name : "action", orderable : false, searchable : false, className : "text-center" }
			
		],
		responsive: true,
		"bStateSave": true,
		"bAutoWidth":false,	
		"ordering": false
	});
    // $(document).on('change', '.live_control > .switch', function(){
    //     $.ajax({
    //         url: _url + '/update/apps/' + $(this).data('id') + '/live_control/' + ($(this).find('input').is(':checked') ? 'on' : 'off'),
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(res) {
    //             console.log(res);

    //             toast(res['result'], res['message']);
    //         }
    //     });
    // });
    // $(document).on('change', '.ads_control > .switch', function(){
    //     $.ajax({
    //         url: _url + '/update/apps/' + $(this).data('id') + '/adscontrol/' + ($(this).find('input').is(':checked') ? 'on' : 'off'),
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function(res) {
    //             console.log(res);

    //             toast(res['result'], res['message']);
    //         }
    //     });
    // });
</script>
@endsection