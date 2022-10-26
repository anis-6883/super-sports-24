<table class="table table-bordered" id="data-table-modal">
	<thead>
		<tr>
			
			<th>{{ _lang('Stream Title') }}</th>
			<th>{{ _lang('Stream Type') }}</th>
			<th width="200">{{ _lang('Stream Url') }}</th>

		</tr>
	</thead>
</table>

<script type="text/javascript">
	$('#data-table-modal').DataTable({
		processing: true,
		serverSide: true,
		ajax: _url + "/live_matches/{{ $live_match->id }}?request_type=data",
		"columns" : [

			{ data : "stream_title", name : "stream_title", className : "stream_title" },
			{ data : "stream_type", name : "stream_type", className : "stream_type" },
			{ data : "stream_url", name : "stream_url", className : "stream_url" },

		],
		responsive: true,
		"bStateSave": false,
		"bAutoWidth":false,	
		"ordering": false,
		"initComplete": function(settings, json) {
		    $('#data-table-modal').DataTable().ajax.reload(null, false);
		}
	});

	$('#data-table-modal').DataTable().ajax.reload(null, false);
</script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
		$("#data-table-modal tbody").sortable({
			update: function(event, ui)
			{
				var streaming_sources = [];
				var streamingSourceOrder = 1;
				$("#data-table-modal tbody > tr").each(function(){
					var id = $(this).data('id');
					streaming_sources.push( { id: id, position: streamingSourceOrder });
					streamingSourceOrder++;
				});

				var streaming_sources = JSON.stringify( streaming_sources );

				console.log(streaming_sources);
				$.ajax({
					method: "POST",
					url: '{{ url("live_matches/reorderStreamingSources") }}',
					data:  { _token: $('[name=csrf-token]').attr('content'), streaming_sources},
					cache: false,
					success: function(data){
$('#data-table-modal').DataTable().ajax.reload(null, false);
$('#data-table').DataTable().ajax.reload(null, false);

						toast('success', data['message']);

					}
				});
			}
		});
	});
</script>