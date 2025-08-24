<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <title>@yield('title', 'Furni')</title>
    @stack('scripts')
</head>

<body>

    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- Left: Logo -->
            <a class="navbar-brand" href="/customer">Pharmacy<span>.</span></a>
            <!-- Center link -->
            <!-- Center links -->
            <div class="d-none d-md-flex justify-content-center flex-grow-1">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customer/orders') ? 'active' : '' }}"
                            href="/customer/orders">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customer/labs') ? 'active' : '' }}"
                            href="/customer/labs">Labs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customer/doctors') ? 'active' : '' }}"
                            href="/customer/doctors">Doctors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('customer/wallet') ? 'active' : '' }}"
                            href="/customer/wallet">Wallet</a>
                </ul>
            </div>

            <!-- Right: Icons -->
            <div class="d-flex align-items-center">
                <ul class="custom-navbar-cta navbar-nav mb-0 d-flex flex-row">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route("customer.profile") }}"><img src="/images/user.svg"
                                alt="User"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.cart') }}"><img src="/images/cart.svg"
                                alt="Cart"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-bottom-nav d-md-none">
        <a href="/customer" class="nav-link{{ request()->is('customer') ? ' active' : '' }}">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('customer.orders') }}"
            class="nav-link{{ request()->is('customer/orders') ? ' active' : '' }}">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Orders</span>
        </a>
        <a href="/customer/labs" class="nav-link{{ request()->is('customer/labs') ? ' active' : '' }}">
            <i class="fa-solid fa-flask"></i>
            <span>Labs</span>
        </a>
        <a href="/customer/doctors" class="nav-link{{ request()->is('customer/doctors') ? ' active' : '' }}">
            <i class="fa-solid fa-user-doctor"></i>
            <span>Doctors</span>
        </a>
        <a href="/customer/wallet" class="nav-link{{ request()->is('customer/wallet') ? ' active' : '' }}">
            <i class="fa-solid fa-wallet"></i>
            <span>Wallet</span>

        </a>
    </nav>

    <!-- End Header/Navigation -->

    <!-- Flash Messages -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    <style>
        body {
            padding-bottom: 60px;
        }

        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #fff;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: center;
            padding: 2px 5px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
            z-index: 9999;
        }

        .mobile-bottom-nav .nav-link {
            text-align: center;
            color: #555;
            font-size: 12px;
            text-decoration: none;
            flex: 1;
        }

        .mobile-bottom-nav .nav-link.active {
            color: #1abc9c !important;
        }

        .mobile-bottom-nav .nav-link i {
            font-size: 18px;
            display: block;
            margin-bottom: 2px;
        }

        @media (min-width: 768px) {
            .mobile-bottom-nav {
                display: none;
            }
        }

        @media screen and (max-width: 600px) {

            .custom-navbar .navbar-brand {
                font-size: 25px !important;
                font-weight: 600;

            }

            .custom-navbar {
                padding-top: 15px;
                padding-bottom: 15px;
            }
        }
    </style>
    <!-- Bootstrap Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Only run on mobile devices
        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        if (isMobile()) {
            let modalShown = false;
            window.history.pushState({ page: 1 }, "", "");
            window.addEventListener("popstate", function (event) {
                if (!modalShown) {
                    var myModal = new bootstrap.Modal(document.getElementById('backConfirmModal'));
                    myModal.show();
                    window.history.pushState({ page: 1 }, "", "");
                    modalShown = true;
                }
            });
            document.getElementById('closeAppBtn').onclick = function () {
                // Try to close the app (works in some webviews)
                window.close();
            };
            document.getElementById('stayBtn').onclick = function () {
                var myModal = bootstrap.Modal.getInstance(document.getElementById('backConfirmModal'));
                myModal.hide();
                modalShown = false;
            };
        }
    </script>

    <!-- Modal HTML -->
    <div class="modal fade" id="backConfirmModal" tabindex="-1" aria-labelledby="backConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="border-bottom: none;">
                    <h5 class="modal-title" id="backConfirmModalLabel" style="color: #1abc9c; font-weight: 600;">Exit
                        App?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-size: 16px; color: #333;">
                    Are you sure you want to close the app?
                </div>
                <div class="modal-footer" style="border-top: none; justify-content: center;">
                    <button type="button" class="btn btn-outline-secondary" id="stayBtn"
                        style="border-radius: 8px;">Stay</button>
                    <button type="button" class="btn btn-success" id="closeAppBtn"
                        style="background: #1abc9c; border-radius: 8px; border: none;">Close App</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>