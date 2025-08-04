@extends('layouts.main')

@section('title', 'Verify Email')

@section('content')
    <div class="text-center mb-4">
        <i class="bi bi-envelope-check text-success" style="font-size: 3rem;"></i>
    </div>
    
    <h2 class="login-title text-center">Verify Your Email</h2>
    
    <div class="text-center mb-4">
        <p class="text-muted">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            A new verification link has been sent to the email address you provided during registration.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-grid gap-3 mb-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-main btn-lg w-100">
                <i class="bi bi-envelope-paper me-2"></i>Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary w-100">
                <i class="bi bi-box-arrow-right me-2"></i>Log Out
            </button>
        </form>
    </div>

    <div class="text-center">
        <span class="text-muted">Need help?</span>
        <a href="{{ route('login') }}" class="signup-link ms-1">Contact Support</a>
    </div>
@endsection
