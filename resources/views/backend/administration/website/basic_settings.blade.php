@extends('layouts.app')
@section('content')
<div class="card-title" style="display: none;">{{ _lang('Basic Settings') }}</div>
<div class="row">
	<div class="col-md-3">
		<div class="nav flex-column nav-pills nav-primary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
			<a class="nav-link active show" id="v-pills-basic_settings-tab" data-toggle="pill" href="#v-pills-basic_settings" role="tab" aria-controls="v-pills-basic_settings" aria-selected="true">{{ _lang('Basic Settings') }}</a>
			<a class="nav-link" id="v-pills-social_links-tab" data-toggle="pill" href="#v-pills-social_links" role="tab" aria-controls="v-pills-social_links" aria-selected="false">{{ _lang('Social Links') }}</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="tab-content" id="v-pills-without-border-tabContent">
			<div class="tab-pane fade active show" id="v-pills-basic_settings" role="tabpanel" aria-labelledby="v-pills-basic_settings-tab">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-3 header-title card-title">{{ _lang('Basic Settings') }}</h3>
						<form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('About') }}</label>
										<textarea class="form-control" name="about">{{ get_option('about') }}</textarea>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Contact Phone') }}</label>
										<input type="text" class="form-control" name="contact_phone" value="{{ get_option('contact_phone') }}" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Contact Email') }}</label>
										<input type="email" class="form-control" name="contact_email" value="{{ get_option('contact_email') }}" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Copyright Text') }}</label>
										<input type="text" class="form-control" name="copyright_text" value="{{ get_option('copyright_text') }}" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Maintenance Break') }}</label>
										<select class="form-control select2" name="maintenance_break" data-selected="{{ get_option('maintenance_break', 0) }}" required>

											<option value="0">{{ _lang('No') }}</option>
											<option value="1">{{ _lang('Yes') }}</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group text-right">
										<button type="submit" class="btn btn-primary btn-sm">
											{{ _lang('Update') }}
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="v-pills-social_links" role="tabpanel" aria-labelledby="v-pills-social_links-tab">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-3 header-title card-title">{{ _lang('Social Links') }}</h3>
						<form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}" style="overflow: unset;">
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Facebook Link') }}</label>
										<input type="text" class="form-control" name="facebook_link" value="{{ get_option('facebook_link') }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">{{ _lang('Instagram Link') }}</label>
										<input type="text" class="form-control" name="instagram_link" value="{{ get_option('instagram_link') }}">
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group text-right">
										<button type="submit" class="btn btn-primary btn-sm">
											{{ _lang('Update') }}
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

