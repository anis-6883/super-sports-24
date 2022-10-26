@extends('layouts.app')
@section('css-stylesheet')
<style>
    .form-check {
        padding-top: 10px;
        margin-bottom: 10px;
    }
    .form-check-label {
        padding: 0px;
        border: none;
        border-radius: 0px;
    }
    .form-check [type="checkbox"]:not(:checked) + .form-check-sign, .form-check [type="checkbox"]:checked + .form-check-sign, .form-check [type="checkbox"] + .form-check-sign {
        position: relative;
        padding: 0px;
        color: #575962;
        cursor: pointer;
    }
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12 mb-2 text-right">
        <h2 class="card-title d-none">{{ _lang('Send Notifications List') }}</h2>
        <a style="color: #fff" class="btn btn-danger btn-sm btn-remove" href="{{ url('notifications/deleteall') }}">
            {{ _lang('Delete All') }}
        </a>
        <a class="btn btn-primary btn-sm" href="{{ route('notifications.create') }}" data-title="{{ _lang('Add New') }}">
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
                            <th style=" white-space: nowrap; width: 5%;">
                                <div class="form-check">
                                    <label class="form-check-label d-flex justify-content-center align-items-center">
                                        <input class="form-check-input" type="checkbox" name="main_checkbox">
                                        <span class="form-check-sign b h4"></span>
                                    </label>
                                </div>
                                <button class="btn btn-sm btn-danger mb-2" id="delete-by-checkbox-btn" disabled>Delete</button>
                            </th>
                            <th style=" white-space: nowrap; width: 30%;">{{ _lang('Title') }}</th>
                            <th style=" white-space: nowrap; width: 30%;">{{ _lang('Body') }}</th>
                            <th style=" white-space: nowrap;">{{ _lang('Created At') }}</th>
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
        ajax: _url + "/notifications",
        "columns" : [

        { data : "checkbox", name : "checkbox", orderable : false, searchable : false },
        { data : "title", name : "title", className: 'details-control', responsivePriority: 1 },
        { data : "message", name : "message", className : "message" },
        { data : "created_at", name : "created_at", className : "created_at" },
        { data : "action", name : "action", orderable : false, searchable : false, className : "text-center" }

        ],
        responsive: true,
        "bStateSave": true,
        "bAutoWidth":false, 
        "ordering": false,
        "drawCallback": function() {
            document.querySelector('input[name="main_checkbox"]').checked = false;
            document.querySelector('#delete-by-checkbox-btn').disabled = true;
            document.querySelector('#delete-by-checkbox-btn').innerText = "Delete";
        },
    });

    // Check All Notification Checkbox
    $(document).on('click', 'input[name="main_checkbox"]', function()
    {
        if(this.checked){
            $('input[name="notify_checkbox"]').each(function(){
                this.checked = true;
            });
        }else{
            $('input[name="notify_checkbox"]').each(function(){
                this.checked = false;
            });
        }
        toggleCheckboxInfo();
    });

    $(document).on('change', 'input[name="notify_checkbox"]', function()
    {
        if($('input[name="notify_checkbox"]').length == $('input[name="notify_checkbox"]:checked').length){
            $('input[name="main_checkbox"]').prop('checked', true);
        }else{
            $('input[name="main_checkbox"]').prop('checked', false);
        }
        toggleCheckboxInfo();
    })

    function toggleCheckboxInfo(){
        if($('input[name="notify_checkbox"]:checked').length > 0){
            $("#delete-by-checkbox-btn").text("Delete (" + $('input[name="notify_checkbox"]:checked').length + ")").prop("disabled", false);
        }else{
            $("#delete-by-checkbox-btn").text("Delete").prop("disabled", true);
        }
    }

    // delete selected notification
    $(document).on("click", "#delete-by-checkbox-btn", function (e) {
        e.preventDefault();
        Swal.fire({
            title: `Do you want to delete selected notification(${$('input[name="notify_checkbox"]:checked').length})?`,
            icon: "warning",
			iconHtml: '🛎️',
            showCancelButton: true,
            confirmButtonColor: "#1bcfb4",
            cancelButtonColor: "#fe7c96",
            confirmButtonText: "Yes, Delete!",
        }).then((result) => {
            if (result.value) {
                
				let checkedNotifications = [];
                $('input[name="notify_checkbox"]:checked').each(function(){
                    checkedNotifications.push($(this).data('id'));
                });

				$.ajax({
					method: "POST",
					url: "{{ route('delete.selected.notification') }}",
					data: {
						notification_ids: checkedNotifications,
						_token: "{{ csrf_token() }}"
					},
                    beforeSend: function () {
                        $("#preloader").css("display", "block");
                    },
					success: function(data){
                        $("#preloader").css("display", "none");
						if(data.result == "success"){
                            $("#data-table").DataTable().ajax.reload(null, false);
							toast("success", data.message);
						}
					}
				})
            }
        });
    });




</script>
@endsection