@extends('layouts.app')
@section('css-stylesheet')
<style>
	tbody tr:hover { 
		box-shadow: 0px 2px 18px 0px rgba(0,0,0,0.5); 
		cursor: pointer; 
		transition: 0.4s; 
		border-radius: 5px} 

</style>
@endsection
@section('content')

<div class="row">
	
	<div class="col-md-12 mb-2 text-right">
		<h2 class="card-title d-none">{{ _lang('Live Matches List') }}</h2>
		<a class="btn btn-primary btn-sm" href="{{ route('live_matches.create') }}" data-title="{{ _lang('Add New') }}">
			<i class="fas fa-plus mr-1"></i>
			{{ _lang('Add New') }}
		</a>
	</div>
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id="data-table" style="width:100%">
					<thead>
						<tr>
							<th style=" white-space: nowrap;">{{ _lang('Team One') }}</th>
							<th style=" white-space: nowrap;">{{ _lang('Team Two') }}</th>
							<th style=" white-space: nowrap; width: 15%;">{{ _lang('Title & Time') }}</th>
							<th style=" white-space: nowrap; width: 35%;">{{ _lang('Apps') }}</th>
							<th style=" white-space: nowrap; width: 5%;" class="text-center">{{ _lang('Action') }}</th>
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
		ajax: _url + "/live_matches",
		"columns" : [

		{ data : "team_one", name : "team_one", className: 'details-control', responsivePriority: 1 },
		{ data : "team_two", name : "team_two", className : "team_two" },
		{ data : "match_time", name : "match_time", className : "match_time text-center" },
		{ data : "apps", name : "apps", className : "apps" },
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
				var matches = [];
				var matchOrder = 1;
				$("#data-table tbody > tr").each(function(){
					var id = $(this).data('id');
					matches.push( { id: id, position: matchOrder });
					matchOrder++;
				});

				var matches = JSON.stringify( matches );

				console.log(matches);
				$.ajax({
					method: "POST",
					url: '{{ url("live_matches/reorder") }}',
					data:  { _token: $('[name=csrf-token]').attr('content'), matches},
					cache: false,
					success: function(data){


						toast('success', data['message']);

					}
				});
			}
		});
	});

	// notify confirmation
    $(document).on("click", ".btn-notify", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Do you want to sent notification?",
            icon: "warning",
			iconHtml: '🛎️',
            showCancelButton: true,
            confirmButtonColor: "#1bcfb4",
            cancelButtonColor: "#fe7c96",
            confirmButtonText: "Yes, Sent it!",
        }).then((result) => {
            if (result.value) {
                var live_match_id = $(this).attr("data-id");
				
				$.ajax({
					method: "POST",
					url: "{{ route('live_matches.notification') }}",
					data: {
						live_match_id: live_match_id,
						_token: "{{ csrf_token() }}"
					},
					success: function(data){
						if(data.status){
							toast("success", data.message);
						}
					}
				})
            }
        });
    });
</script>
@endsection