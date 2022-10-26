@extends('layouts.app')
@section('content')
<div class="card-title" style="display: none;">{{ _lang('Pages') }}</div>
<div class="row">
	<div class="col-md-3">
		<div class="nav flex-column nav-pills nav-primary nav-pills-no-bd" id="v-pills-tab-without-border" role="tablist" aria-orientation="vertical">
			<a class="nav-link active show" id="v-pills-privacy_policy-tab" data-toggle="pill" href="#v-pills-privacy_policy" role="tab" aria-controls="v-pills-privacy_policy" aria-selected="true">{{ _lang('Privacy Policy') }}</a>
			<a class="nav-link" id="v-pills-terms_and_condition-tab" data-toggle="pill" href="#v-pills-terms_and_condition" role="tab" aria-controls="v-pills-terms_and_condition" aria-selected="false">{{ _lang('Terms and condition') }}</a>
		</div>
	</div>
	<div class="col-md-9">
		<div class="tab-content" id="v-pills-without-border-tabContent">
			<div class="tab-pane fade active show" id="v-pills-privacy_policy" role="tabpanel" aria-labelledby="v-pills-privacy_policy-tab">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-3 header-title card-title">{{ _lang('Privacy Policy') }}</h3>
						<form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Content') }}</label>
										<textarea class="form-control summernote" name="privacy_policy" required>{{ get_option('privacy_policy') }}</textarea>
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
			<div class="tab-pane fade" id="v-pills-terms_and_condition" role="tabpanel" aria-labelledby="v-pills-terms_and_condition-tab">
				<div class="card">
					<div class="card-body">
						<h3 class="mb-3 header-title card-title">{{ _lang('Terms and condition') }}</h3>
						<form method="post" class="ajax-submit2 params-card" autocomplete="off" action="{{ route('store_settings') }}" style="overflow: unset;">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">{{ _lang('Content') }}</label>
										<textarea class="form-control summernote" name="terms_and_condition" required>{{ get_option('terms_and_condition') }}</textarea>
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


