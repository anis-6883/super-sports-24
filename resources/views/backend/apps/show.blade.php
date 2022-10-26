@extends('layouts.app')

@section('content')
<h4 class="card-title d-none">{{ _lang('Details') }}</h4>
<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
					
					<tr>
						<td>{{ _lang('App Unique Id ') }}</td>
						<td>{{ $app->app_unique_id  }}</td>
					</tr>
					<tr>
						<td>{{ _lang('App Name') }}</td>
						<td>{{ $app->app_name }}</td>
					</tr>
					<tr>
						<td>{{ _lang('App Logo') }}</td>
						<td>{{ $app->app_logo }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Privacy Policy Link') }}</td>
						<td>{{ $app->privacy_policy_link }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Live Control') }}</td>
						<td>{{ $app->live_control }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Ads Control') }}</td>
						<td>{{ $app->ads_control }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Have Play Url') }}</td>
						<td>{{ $app->have_play_url }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Play Url') }}</td>
						<td>{{ $app->play_url }}</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
@endsection


