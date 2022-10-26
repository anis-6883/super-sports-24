@extends('layouts.app')

@section('content')
<h3 class="auth-title">{{ _lang('Confirm Password') }}</h3>
@error('email')
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@enderror
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf
    <div class="form-group position-relative has-icon-left mb-4">
        <input type="password" class="form-control form-control-xl" name="password" placeholder="Password">
        <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
        </div>
    </div>
    <div class="form-check form-check-lg d-flex align-items-end">
        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label text-gray-600" for="flexCheckDefault">
            {{ _lang('Keep me logged in') }}
        </label>
    </div>
    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">{{ _lang('Confirm Password') }}</button>
</form>
<div class="text-center mt-5 text-lg fs-4">
    <p><a class="font-bold" href="{{ route('password.request') }}"> {{ _lang('Forgot Your Password?') }}</a>.</p>
</div>
@endsection
