<html>
@php
	$payment = $content->payment;
@endphp

<body style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;padding-top: 10px;padding-bottom: 10px;">


	<table style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);">
		<thead>
			<tr>
				<th style="text-align:left;">
					<img style="width: 50px;" src="{{ asset($payment->app->app_logo) }}" alt="{{ get_option('company_name') }}">
				</th>
				<th style="text-align:right;font-weight:400;">{{ date('jS F Y', strtotime($payment->created_at)) }}</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td >
					<b>Dear {{ $payment->app->app_name }} Customer</b>
				</td>
			</tr>
			<tr colspan="2">
				<td style="height:15px;">
					This email confirms your football rocker Premium subscription purchase, below are the details of your subscription.
				</td>
			</tr>
			<tr>
				<td style="height:35px;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
					<p style="font-size:14px;margin:0 0 6px 0;">
						<span style="font-weight:bold;display:inline-block;min-width:150px">{{ _lang('Order Status') }}</span>
						<b style="font-weight:normal;margin:0;">
							Accepted
						</b>
					</p>
					<p style="font-size:14px;margin:0 0 6px 0;">
						<span style="font-weight:bold;display:inline-block;min-width:146px">{{ _lang('Order Id') }}</span>
						{{ sprintf("%06d", $payment->id) }}
					</p>
					<p style="font-size:14px;margin:0 0 6px 0;">
						<span style="font-weight:bold;display:inline-block;min-width:146px">{{ _lang('Sub Total') }}</span>
						 {{ ($payment->amount) }}
					</p>
					<p style="font-size:14px;margin:0 0 6px 0;">
						<span style="font-weight:bold;display:inline-block;min-width:146px">{{ _lang('Total') }}</span>
						 {{ ($payment->amount) }}
					</p>
				</td>
			</tr>
			<tr>
				<td style="height:35px;"></td>
			</tr>
			<tr>
				<td style="width:50%;padding:20px;vertical-align:top">
					<p style="margin:0 0 10px 0;padding:0;font-size:14px;">
						<span style="display:block;font-weight:bold;font-size:13px">{{ _lang('Name') }}</span> {{ $payment->user->name }} 
					</p>
					<p style="margin:0 0 10px 0;padding:0;font-size:14px;">
						<span style="display:block;font-weight:bold;font-size:13px;">{{ _lang('Email') }}</span> {{ $payment->user->display_email }}
					</p>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">{{ _lang('Items') }}</td>
			</tr>
			<tr>
				<td colspan="2" style="padding:15px;">
					<p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;">
						<span style="font-size:13px;font-weight:normal;padding-right: 60px;">
							{{ $payment->subscription->name }} 
						</span>
						<span>
							{{ ($payment->amount) }}
						</span>
						<b style="font-size:12px;font-weight:300;display: block;">
							
						</b>
					</p>
				</td>
			</tr>
		</tbody>
		<tfooter>
			<tr>
				<td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">
					<strong style="display:block;margin:0 0 10px 0;">{{ _lang('Regards') }}</strong>
					{{ $payment->app->from_name }} <br>
					<br>
					In case of any query contact {{ $payment->app->support_mail }}
				</td>
			</tr>
		</tfooter>
	</table>
</body>

</html>