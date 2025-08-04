@extends('layouts.main')

@section('title', 'Register')

@section('content')
    <h2 class="login-title text-center">Create Account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" placeholder="Enter your full name" required autocomplete="name" autofocus>
            </div>
            @error('name')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="username">
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
                    placeholder="Enter your password" required autocomplete="new-password">
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

        <div class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock-fill"></i>
                </span>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                <span class="input-group-text toggle-password" id="togglePassword">
                    <i class="bi bi-eye-slash"></i>
                </span>
            </div>
            @error('password_confirmation')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="d-grid mb-4">
            <button type="submit" class="btn btn-main btn-lg">
                <i class="bi bi-person-plus me-2"></i>Create Account
            </button>
        </div>
    </form>

    <div class="text-center mb-4">
        <span class="text-muted">Already have an account?</span>
        <a href="{{ route('login') }}" class="signup-link ms-1">Sign In</a>
    </div>

    <div class="or-separator">OR</div>

    <div class="d-grid gap-2">
        <button class="btn btn-social" onclick="handleSocialLogin('google')">
            <img src="https://img.icons8.com/color/20/000000/google-logo.png" class="social-icon" alt="Google" />
            Sign up with Google
        </button>
        <button class="btn btn-social" onclick="handleSocialLogin('apple')">
            <img src="https://img.icons8.com/ios-filled/20/000000/mac-os.png" class="social-icon" alt="Apple" />
            Sign up with Apple
        </button>
        <button class="btn btn-social" onclick="handleSocialLogin('facebook')">
            <img src="https://img.icons8.com/ios-filled/20/000000/facebook-new.png" class="social-icon" alt="Facebook" />
            Sign up with Facebook
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

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const passwordInput = document.querySelector('input[name="password_confirmation"]');
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