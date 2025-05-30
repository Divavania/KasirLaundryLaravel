<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Khalifah Laundry')</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212 !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode .content-wrapper {
            background: #1e1e1e !important;
        }
        body.dark-mode .main-sidebar {
            background-color: #222 !important;
            color: #ccc !important;
        }
        body.dark-mode .nav-sidebar .nav-link {
            color: #ccc !important;
        }
        body.dark-mode .nav-sidebar .nav-link.active {
            background-color: #444 !important;
            color: #a5d6a7 !important;
        }
        body.dark-mode .brand-link {
            background: #1f1f1f !important;
            color: #a5d6a7 !important;
        }
        body.dark-mode .navbar {
            background-color: #1f1f1f !important;
            border-bottom: 1px solid #444 !important;
        }
        body.dark-mode .card {
            background-color: #2a2a2a !important;
            border-color: #444 !important;
        }
        body.dark-mode .card-header {
            background: #28a745 !important; /* Keep green header for consistency */
        }
        body.dark-mode .table {
            background-color: #2a2a2a !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode .table th {
            background: #333 !important;
            color: #a5d6a7 !important;
        }
        body.dark-mode .table tbody tr:hover {
            background: #333 !important;
        }
        body.dark-mode .info-box {
            background: #2a2a2a !important;
            border-color: #444 !important;
        }
        body.dark-mode .select2-container--default .select2-selection--single {
            background: #333 !important;
            border-color: #444 !important;
            color: #e0e0e0 !important;
        }
        body.dark-mode .modal-content {
            background: #2a2a2a !important;
            color: #e0e0e0 !important;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .content-wrapper {
            background: linear-gradient(135deg, #e8f5e9, #f5f5f5);
            position: relative;
            min-height: 100vh;
            padding-top: 10px; /* Space for mobile toggle button */
        }
        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><circle cx="30" cy="30" r="15" fill="rgba(40,167,69,0.08)"/><circle cx="170" cy="50" r="10" fill="rgba(40,167,69,0.1)"/><circle cx="100" cy="150" r="20" fill="rgba(40,167,69,0.08)"/><circle cx="50" cy="100" r="8" fill="rgba(40,167,69,0.12)"/></svg>');
            background-size: 300px;
            opacity: 0.2;
            z-index: -1;
            animation: float 20s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }
        .card {
            border: 1px solid rgba(40, 167, 69, 0.15);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: #28a745;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-weight: 500;
        }
        .info-box {
            border-radius: 8px;
            border: 1px solid rgba(40, 167, 69, 0.15);
        }
        .info-box-icon {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        .table th {
            font-weight: 500;
            color: #2e7d32;
            background: #e8f5e9;
        }
        .table tbody tr:hover {
            background: rgba(40, 167, 69, 0.05);
        }
        .btn-success, .btn-primary, .btn-warning, .btn-danger {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-success {
            background: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover, .btn-primary:hover {
            background: #2e7d32;
            border-color: #2e7d32;
            box-shadow: 0 3px 8px rgba(46, 125, 50, 0.2);
            transform: translateY(-1px);
        }
        .btn-warning {
            background: #fb8c00;
            border-color: #fb8c00;
        }
        .btn-warning:hover {
            background: #ef6c00;
            border-color: #ef6c00;
        }
        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
            border-color: #c82333;
        }
        .select2-container--default .select2-selection--single {
            border-radius: 6px;
            border: 1px solid #d4edda;
            background: #f8faf8;
            height: 38px;
            padding: 5px;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .select2-container--default .select2-selection--single:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 6px rgba(46, 125, 50, 0.2);
        }
        .swal2-custom {
            border-radius: 10px !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
            font-family: 'Poppins', sans-serif !important;
        }
        .swal2-title-custom {
            font-size: 1.4rem !important;
            color: #2e7d32 !important;
        }
        .swal2-content-custom {
            font-size: 0.95rem !important;
            color: #495057 !important;
        }
        /* Sidebar Styles */
        .sidebar-dark-primary {
            background-color: #ffffff !important;
            border-right: 1px solid #d4edda !important;
        }
        .brand-link {
            background: #f8f9fa !important;
            color: #28a745 !important;
            font-weight: 600;
            border-bottom: 1px solid #d4edda !important;
            padding: 15px;
        }
        .nav-sidebar .nav-link {
            color: #28a745 !important;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 2px 5px;
        }
        .nav-sidebar .nav-link:hover {
            color: #2e7d32 !important;
            background-color: #e8f5e9 !important;
        }
        .nav-sidebar .nav-link.active {
            background-color: #d4edda !important;
            color: #2e7d32 !important;
            font-weight: 600;
        }
        .nav-sidebar .nav-treeview .nav-link {
            color: #28a745 !important;
            padding-left: 30px;
            font-size: 0.95rem;
        }
        .nav-sidebar .nav-treeview .nav-link:hover {
            color: #2e7d32 !important;
            background-color: #e8f5e9 !important;
        }
        .nav-sidebar .nav-treeview .nav-link.active {
            background-color: #d4edda !important;
            color: #2e7d32 !important;
        }
        .nav-sidebar .nav-link.logout {
            color: #dc3545 !important;
            font-weight: 600;
        }
        .nav-sidebar .nav-link.logout:hover {
            color: #c82333 !important;
            background-color: #f8d7da !important;
        }
        /* Sidebar Toggle Button */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1060;
            background: #28a745;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 1rem;
        }
        .sidebar-toggle:hover {
            background: #2e7d32;
        }
        /* Responsive Styles */
        @media (max-width: 767.98px) {
            .main-sidebar {
                transform: translate(-100%, 0);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar-open .main-sidebar {
                transform: translate(0, 0);
            }
            .content-wrapper {
                margin-left: 0 !important;
                padding: 10px;
            }
            .card {
                margin-bottom: 10px;
            }
            .sidebar-toggle {
                display: block;
            }
            .modal-dialog {
                margin: 8px;
                max-width: 95%;
            }
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table th, .table td {
                padding: 6px;
                font-size: 0.9rem;
            }
            .btn-group .btn {
                padding: 3px 5px;
                font-size: 0.8rem;
            }
            .swal2-popup {
                width: 85% !important;
                font-size: 0.9rem !important;
            }
        }
    </style>
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Top Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #f8f9fa; border-bottom: 1px solid #d4edda;">
        <!-- Sidebar toggle button (hamburger) -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-success"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto align-items-center">
            <!-- Dark mode toggle -->
            <li class="nav-item">
                <button id="darkModeToggle" class="btn btn-sm btn-outline-success" title="Toggle Dark Mode">
                    <i id="darkModeIcon" class="fas fa-moon"></i>
                </button>
            </li>

            <!-- User Logo / Icon -->
            @auth
                <li class="nav-item ml-3">
                    <a href="#" class="nav-link d-flex align-items-center" style="color: green;">
                        <i class="fas fa-user-circle fa-lg"></i>
                        <span class="ml-2">{{ auth()->user()->username ?? 'User' }}</span>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ auth()->check() ? (auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard')) : '#' }}" class="brand-link">
            <span class="brand-text font-weight-bold">Kasir Laundry</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    @auth
                        <li class="nav-item">
                            <a href="{{ auth()->user()->role == 'superadmin' ? route('superadmin.dashboard') : route('admin.dashboard') }}" class="nav-link @yield('dashboard-active')">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if(auth()->user()->role == 'superadmin')
                            <li class="nav-item has-treeview @yield('master-data-active')">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-database"></i>
                                    <p>
                                        Master Data
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.index') }}" class="nav-link @yield('admin-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kelola Admin</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('layanan.index') }}" class="nav-link @yield('layanan-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kelola Layanan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pelanggan.index') }}" class="nav-link @yield('pelanggan-active')">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kelola Pelanggan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @elseif(auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('pelanggan.index') }}" class="nav-link @yield('pelanggan-active')">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Kelola Pelanggan</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link logout">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    @endauth
                    @yield('sidebar')
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        @yield('content')
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2();

        // Keep Master Data submenu open if active
        @if (request()->routeIs('admin.index') || request()->routeIs('layanan.index') || request()->routeIs('pelanggan.index'))
            $('.nav-item.has-treeview').addClass('menu-open');
            $('.nav-item.has-treeview > a').addClass('active');
        @endif

        // Dark mode persistence
        const toggleButton = document.getElementById('darkModeToggle');
        const icon = document.getElementById('darkModeIcon');

        // Apply saved mode on page load
        const savedMode = localStorage.getItem('theme') || 'light';
        if (savedMode === 'dark') {
            document.body.classList.add('dark-mode');
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            document.body.classList.remove('dark-mode');
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }

        // Toggle dark mode on button click
        toggleButton.addEventListener('click', function () {
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
            icon.classList.toggle('fa-moon', !isDarkMode);
            icon.classList.toggle('fa-sun', isDarkMode);
        });
    });
</script>
@yield('scripts')
</body>
</html>