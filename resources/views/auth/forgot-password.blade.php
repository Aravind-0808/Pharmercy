@extends('layouts.main')

@section('title', 'Forgot Password')

@section('content')
    <a href="{{ route('login') }}" class="back-link mb-4 d-inline-block">
        <i class="bi bi-arrow-left me-2"></i>Back to Login
    </a>
    
    <h2 class="login-title text-center">Reset Password</h2>
    
    <div class="text-center mb-4">
        <p class="text-muted">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" 
                       value="{{ old('email') }}"
                       placeholder="Enter your email address" 
                       required 
                       autofocus>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-main btn-lg">
                <i class="bi bi-envelope-paper me-2"></i>Send Reset Link
            </button>
        </div>
    </form>

    <div class="text-center">
        <span class="text-muted">Remember your password?</span>
        <a href="{{ route('login') }}" class="signup-link ms-1">Sign In</a>
    </div>
@endsection
