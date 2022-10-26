@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12 mb-2 text-right">
		<h2 class="card-title d-none">{{ _lang('Sports Types List') }}</h2>
		<a class="btn btn-primary btn-sm ajax-modal" href="{{ route('sports_types.create') }}" data-title="{{ _lang('Add New') }}">
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
							
							<th>{{ _lang('Sports Name') }}</th>
        					<th>{{ _lang('Sports SKQ') }}</th>
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
		ajax: _url + "/sports_types",
		"columns" : [
			
			{ data : "sports_name", name : "sports_name", className : "sports_name" },
        	{ data : "sports_skq", name : "sports_skq", className : "sports_skq" },
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