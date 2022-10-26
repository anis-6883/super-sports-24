@extends('layouts.auth')

@section('content')
<h3 class="auth-title">{{ _lang('Verify Your Email Address') }}</h3>
@if (session('resent'))
<div class="alert alert-success" role="alert">
    {{ __('A fresh verification link has been sent to your email address.') }}
</div>
@endif
<form method="POST" action="{{ route('verification.resend') }}">
    @csrf
    
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">{{ _lang('click here to request another') }}</button>
</form>
@endsection
