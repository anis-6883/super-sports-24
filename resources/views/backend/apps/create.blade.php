@extends('layouts.app')

@section('content')
<h4 class="card-title d-none">{{ _lang('Add New') }}</h4>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<form class="ajax-submit2" method="post" autocomplete="off" action="{{ route('apps.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('App Name') }}</label>
								<input type="text" name="app_name" class="form-control" value="{{ old('app_name') }}" required >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('App Unique Id') }}</label>
								<input type="text" name="app_unique_id" class="form-control" value="{{ time() }}_{{ rand() }}" readonly required>
							</div>
						</div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('App Logo Type') }}</label>
                                <select class="form-control select2" name="app_logo_type" required>
                                    <option value="">{{ _lang('None') }}</option>
									<option value="url">{{ _lang('Url') }}</option>
									<option value="image">{{ _lang('Image') }}</option>
                                </select>
                            </div>
                        </div>
						<div class="col-md-12 d-none">
							<div class="form-group">
								<label class="control-label">{{ _lang('Image Url') }}</label>
								<input type="url" class="form-control" name="app_logo_url" value="{{ old('app_logo_url') }}" >
							</div>
						</div>
						<div class="col-md-12 d-none">
							<div class="form-group">
								<label class="control-label">{{ _lang('Image') }}</label>
								<input type="file" class="form-control dropify" name="app_logo" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
							</div>
						</div>
						<div class="col-md-12 d-none">
							<div class="form-group" id="app_logo_show"></div>
						</div>

						<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Notification Type') }}</label>
                                <select class="form-control select2" name="notification_type" required>
                                    <option value="onesignal">{{ _lang('One Signal') }}</option>
                                    <option value="fcm">{{ _lang('FCM') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 onesignal">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('One Signal App ID') }}</label>
								<input type="text" name="onesignal_app_id" class="form-control" value="{{ old('onesignal_app_id') }}" required>
							</div>
						</div>
						<div class="col-md-6 onesignal">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('One Signal Api Key') }}</label>
								<input type="text" name="onesignal_api_key" class="form-control" value="{{ old('onesignal_api_key') }}" required>
							</div>
						</div>
						<div class="col-md-12 fcm d-none">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('Firebase Server Key') }}</label>
								<input type="text" name="firebase_server_key" class="form-control" value="{{ old('firebase_server_key') }}" disabled required>
							</div>
						</div>
						<div class="col-md-12 fcm d-none">
							<div class="form-group">
								<label class="form-control-label">{{ _lang('Firebase Topics') }}</label>
								<input type="text" name="firebase_topics" class="form-control" value="{{ old('firebase_topics') }}" disabled required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('Support Mail') }}</label>
								<input type="text" class="form-control" name="support_mail" value="{{ old('support_mail') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('From Mail') }}</label>
								<input type="text" class="form-control" name="from_mail" value="{{ old('from_mail') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('From Name') }}</label>
								<input type="text" class="form-control" name="from_name" value="{{ old('from_name') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('SMTP Host') }}</label>
								<input type="text" class="form-control smtp" name="smtp_host" value="{{ old('smtp_host') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('SMTP Port') }}</label>
								<input type="text" class="form-control smtp" name="smtp_port" value="{{ old('smtp_port') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('SMTP Username') }}</label>
								<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="{{ old('smtp_username') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('SMTP Password') }}</label>
								<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="{{ old('smtp_password') }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">{{ _lang('SMTP Encryption') }}</label>
								<select class="form-control smtp" name="smtp_encryption" data-selected="{{ old('smtp_encryption', 'ssl') }}">
									<option value="ssl">{{ _lang('SSL') }}</option>
									<option value="tls">{{ _lang('TLS') }}</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">{{ _lang('Status') }}</label>
                                <select class="form-control select2" name="status" required>
                                    <option value="1">{{ _lang('Active') }}</option>
                                    <option value="0">{{ _lang('In-Active') }}</option>
                                </select>
                            </div>
                        </div>
						<div class="col-md-12">
							<div class="form-group">
								<button type="reset" class="btn btn-danger btn-sm">{{ _lang('Reset') }}</button>
								<button type="submit" class="btn btn-primary btn-sm">{{ _lang('Save') }}</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
	$('[name=notification_type]').on('change', function() {
		if($(this).val() == 'onesignal'){
			$('.onesignal').removeClass('d-none').find('input').attr('disabled', false);
			$('.fcm').addClass('d-none').find('input').attr('disabled', true);
		}else{
			$('.fcm').removeClass('d-none').find('input').attr('disabled', false);
			$('.onesignal').addClass('d-none').find('input').attr('disabled', true);
		}
	});
	$('[name=app_name]').on('keyup', function() {
		$('[name=firebase_topics]').val($(this).val().replace(/\s/g, ''));
	});

	// Handle App Logo Image/URL
    $('[name=app_logo_type]').on('change', function() {
        $('[name=app_logo]').closest('.col-md-12').addClass('d-none');
        $('[name=app_logo_url]').closest('.col-md-12').addClass('d-none');
        
        if($(this).val() == 'url'){
            $('[name=app_logo]').removeAttr('required').val("");
            $('[name=app_logo_url]').attr("required", true).closest('.col-md-12').removeClass('d-none');
        }else if($(this).val() == 'image'){
            $('[name=app_logo_url]').removeAttr('required').val("");
            $('[name=app_logo]').attr("required", true).closest('.col-md-12').removeClass('d-none');
            $('#app_logo_show').parent().addClass('d-none');
        }else{
            $('[name=app_logo]').removeAttr('required').val("").closest('.col-md-12').addClass('d-none');
            $('[name=app_logo_url]').removeAttr('required').val("").closest('.col-md-12').addClass('d-none');
            $('#app_logo_show').parent().addClass('d-none');
        }
    });

    $('[name=app_logo_url]').on('keyup', function() {
		$('#app_logo_show').parent().removeClass('d-none');
        $('#app_logo_show').html('<img src="' + $(this).val() + '" style="width: 150px; border-radius: 10px;">');
    });
</script>
@endsection


