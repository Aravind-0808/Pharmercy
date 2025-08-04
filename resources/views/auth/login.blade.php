@extends('layouts.main')

@section('title', 'Login')

@section('content')
    <h2 class="login-title text-center">Welcome Back</h2>

    @if (session('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="email" autofocus>
            </div>
            @error('email')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Enter your password" required autocomplete="current-password" id="passwordInput">
                <span class="input-group-text toggle-password" id="togglePassword">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
            @error('password')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="mb-3 text-end">
            <a href="{{ route('password.request') }}" class="forgot-password-link">
                Forgot Password?
            </a>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-main btn-lg">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </div>
    </form>

    <div class="text-center mb-4">
        <span class="text-muted">Don't have an account?</span>
        <a href="{{ route('register') }}" class="signup-link ms-1">Sign Up</a>
    </div>

    <div class="or-separator">OR</div>

    <div class="d-grid gap-2">
        <button class="btn btn-social" onclick="handleSocialLogin('google')">
            <img src="https://img.icons8.com/color/20/000000/google-logo.png" class="social-icon" alt="Google" />
            Sign in with Google
        </button>
        <button class="btn btn-social" onclick="handleSocialLogin('apple')">
            <img src="https://img.icons8.com/ios-filled/20/000000/mac-os.png" class="social-icon" alt="Apple" />
            Sign in with Apple
        </button>
        <button class="btn btn-social" onclick="handleSocialLogin('facebook')">
            <img src="https://img.icons8.com/ios-filled/20/000000/facebook-new.png" class="social-icon" alt="Facebook" />
            Sign in with Facebook
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.querySelector('input[name="password"]');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });

        // Handle social login (placeholder function)
        function handleSocialLogin(provider) {
            console.log(`Social login with ${provider} - Implement your OAuth logic here`);
            // You can implement your OAuth logic here
            // For example: window.location.href = `/auth/${provider}`;
        }
    </script>
@endpush