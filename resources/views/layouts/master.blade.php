<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LaraStart</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
{{--    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

{{--    <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">--}}
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link">
            <img src="{{ asset('img/logo.png') }}" alt="Lara Start Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Lara Start</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('img/profile.png') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
                            <p>
                                Dashboard
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item menu-close">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog text-green"></i>
                            <p>
                                Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link to="/users" class="nav-link">
                                    <i class="fas fa-users nav-icon text-cyan"></i>
                                    <p>Users</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <router-link to="/profile" class="nav-link">
                            <i class="nav-icon fas fa-user text-orange"></i>
                            <p>
                                Profile
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            <i class="nav-icon fas fa-power-off text-red"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <router-view></router-view>

                <!-- set progressbar -->
                <vue-progress-bar></vue-progress-bar>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Version: 1.0.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-{{ date('Y') }} <a href="#">MajestySoft</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ mix('js/app.js') }}"></script>
{{--<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>--}}
{{--<script>--}}
{{--    $('#user-list').DataTable()--}}
{{--</script>--}}
</body>
</html>
