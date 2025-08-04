<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            color: #6c757d;
        }

        .form-control {
            border-radius: 25px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 0%;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #1abc9c;
            box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
        }

        .btn-main {
            border-radius: 25px;
            background-color: #1abc9c;
            border: none;
            color: #fff;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 5px !important;
        }

        .btn-main:hover {
            background-color: #16a085;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(26, 188, 156, 0.3);
            border-radius: 5px !important;
        }

        .btn-social {
            border-radius: 25px;
            background-color: #fff;
            border: 1px solid #e9ecef;
            color: #495057;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.3s ease;
            margin-bottom: 10px;
            border-radius: 5px !important;
        }

        .btn-social:hover {
            background-color: #f8f9fa;
            border-color: #1abc9c;
            color: #1abc9c;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px !important;
        }

        .or-separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #6c757d;
            font-weight: 500;
        }

        .or-separator::before,
        .or-separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e9ecef;
        }

        .or-separator::before {
            margin-right: 15px;
        }

        .or-separator::after {
            margin-left: 15px;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
            width: 100%;
        }

        .login-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 1800px !important;
        }

        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #1abc9c;
        }

        .login-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .forgot-password-link {
            color: #1abc9c;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
            color: #16a085;
        }

        .signup-link {
            color: #1abc9c;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .signup-link:hover {
            color: #16a085;
        }

        .social-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        @media (max-width: 768px) {
            .login-card {
                padding: 30px 20px;
            }

            .login-container {
                padding: 10px 0;
            }
        }

        /* New styles for larger screens */
        @media (min-width: 992px) {
            .login-card {
                padding: 50px 40px;
                max-width: 500px;
                margin: 0 auto;
            }

            .login-title {
                font-size: 2.5rem;
                margin-bottom: 40px;
            }

            .form-control {
                padding: 15px 25px;
                font-size: 18px;
                border-radius: 0%;
            }

            .btn-main,
            .btn-social {
                padding: 15px 30px;
                font-size: 18px;
            }

            .input-group-text {
                padding: 0 20px;
            }

            .social-icon {
                width: 24px;
                height: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-6"> <!-- Increase these values -->
                    <div class="login-card w-100">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>