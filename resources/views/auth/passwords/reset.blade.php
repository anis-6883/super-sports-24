@extends('layouts.auth')

@section('content')
<h3 class="auth-title">{{ _lang('Reset Password') }}</h3>
@foreach ($errors->all() as $error)
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endforeach
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" value="{{ old('email') }}">
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl" name="password" placeholder="{{ _lang('Password') }}">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl" name="password_confirmation" placeholder="{{ _lang('Confirm Password') }}">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">{{ _lang('Reset Password') }}</button>
</form>
@endsection
