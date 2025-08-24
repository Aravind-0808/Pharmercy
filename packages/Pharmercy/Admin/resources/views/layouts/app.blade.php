<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #1abc9c;
            /* Updated primary color */
            --secondary-color: #82868B;
            --success-color: #28C76F;
            --danger-color: #EA5455;
            --warning-color: #FF9F43;
            --info-color: #00CFE8;
        }

        .card-statistic {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            transition: all 0.3s ease;
        }

        .card-statistic:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px 0 rgba(34, 41, 47, 0.15);
        }

        .card-statistic .card-title {
            font-size: 14px;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .card-statistic .card-value {
            font-size: 24px;
            font-weight: 600;
            color: #5E5873;
            margin-bottom: 0;
        }

        .sidebar-dark-primary {
            background-color: #FFFFFF;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
        }

        .sidebar-dark-primary .brand-link,
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link {
            color: #6E6B7B;
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
            background-color: rgba(115, 103, 240, 0.12);
            color: var(--primary-color);
        }

        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link:hover {
            color: var(--primary-color);
        }

        .brand-link {
            border-bottom: 1px solid #EBE9F1;
            justify-content: center;
            padding: 1.5rem 1rem;
        }

        .main-header {
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            border-bottom: 1px solid #EBE9F1;
            background: #FFFFFF;
        }

        .content-wrapper {
            background-color: #F8F8F8;
        }

        .profit-badge {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            background-color: rgba(40, 199, 111, 0.12);
            color: var(--primary-color);
            /* Updated to use primary color */
        }

        .stock-card {
            border-left: 4px solid var(--primary-color);
            /* Updated to use primary color */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-user-circle"></i> Admin
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-bold">ADMIN</span> <!-- Updated brand name -->
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active"> <!-- Updated route -->
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <!-- Store Management -->
                        <li class="nav-item">
                            <a href="{{ route('admin.store.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-store"></i>
                                <p>Store Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-store"></i>
                                <p>Products Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Orders Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.transaction.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.wallet.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Wallet Transaction</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.store.wallet.amount') }}" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Store Wallets</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.withdrawal.request') }}" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>Withdrawal Requests</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.bank.details') }}" class="nav-link">
                                <i class="nav-icon fas fa-university"></i>
                                <p>Bank Details</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.doctors.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-user-md"></i>
                                <p>Doctors Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.labs.table') }}" class="nav-link">
                                <i class="nav-icon fas fa-vials"></i>
                                <p>Labs Management</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content pt-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('scripts')
</body>

</html>