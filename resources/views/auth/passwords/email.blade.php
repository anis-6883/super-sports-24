@extends('layouts.auth')

@section('content')
<h3 class="auth-title">{{ _lang('Reset Password') }}</h3>
@error('email')
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="email" class="form-control form-control-xl" placeholder="Email" name="email" value="{{ old('email') }}">
        <div class="form-control-icon">
            <i class="bi bi-person"></i>
        </div>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">{{ _lang('Send Password Reset Link') }}</button>
</form>
@endsection
