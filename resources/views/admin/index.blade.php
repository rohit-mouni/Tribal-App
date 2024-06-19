<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title')</title>

    <script>
        var base_url = '{{ config('app.url') }}';
    </script>
    <!-- Google Font: Source Sans Pro -->
    <!-- jQuery -->
    <script src="{{ asset('/admin-assets/plugins/jquery/jquery.min.js') }}"></script>
    {{-- --toster links--- --}}
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <!-- Toastr JS -->
    <script src="{{ url('/admin-assets/plugins/toastr/toastr.min.js') }}"></script>

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    {{-- --toster links end here--- --}}

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/dist/css/adminlte.min.css') }}">
    <!-- TOASTR -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/toastr/toastr.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/admin-assets/plugins/summernote/summernote-bs4.min.css') }}">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-----Custom Style Sheet------->
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/css/admin.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!--------------Navbar header part start ----------------------->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        @if (!empty(Auth::user()->profile_image))
                            <img src="{{ url('/admin-assets/uploads/profileimages') }}/{{ auth()->user()->profile_image }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ url('/admin-assets/uploads/placeholderImage/admin.jpg') }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                        @endif

                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            @if (!empty(Auth::user()->profile_image))
                                <img src="{{ url('/admin-assets/uploads/profileimages') }}/{{ auth()->user()->profile_image }}"
                                    class="user-image img-circle elevation-2" alt="User Image">
                            @else
                                <img src="{{ url('/admin-assets/uploads/placeholderImage/admin.jpg') }}"
                                    class="user-image img-circle elevation-2" alt="User Image">
                            @endif
                            <p> {{ auth()->user()->name }} </p>
                        </li>
                </li>
                <li class="user-footer">
                    <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
            </ul>
        </nav>
        <!---------------------Navbar header part end here--------------->

        <!------------------------- Main Sidebar Container----------------------------->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (!empty(Auth::user()->profile_image))
                            <img src="{{ url('/admin-assets/uploads/profileimages') }}/{{ auth()->user()->profile_image }}"
                                class="img-circle elevation-2" alt="User Image"
                                style="height: 2.1rem; width: 2.1rem; object-fit: cover;">
                        @else
                            <img src="{{ url('/admin-assets/uploads/placeholderImage/admin.jpg') }}"
                                class="img-circle elevation-2" alt="User Image"
                                style="height: 2.1rem; width: 2.1rem; object-fit: cover;">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column sidebar-dark-primary" data-widget="treeview"
                        role="menu" data-accordion="false">
                        <li class="nav-item ">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!----All-Users----->
                        <li class="nav-item">
                            <a href="{{ route('user.list') }}"
                                class="nav-link {{ Route::currentRouteName() == 'user.list' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        {{-- ------category----------- --}}
                        {{-- <li
                            class="nav-item  {{ Route::currentRouteName() == 'category.list' || Route::currentRouteName() == 'sub.category.list' || Route::currentRouteName() == 'get_addon' ? 'menu-open' : '' }}">
                            <a href=""
                                class="nav-link {{ Route::currentRouteName() == 'category.list' || Route::currentRouteName() == 'sub.category.list' || Route::currentRouteName() == 'get_addon' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('category.list') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'category.list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Category-List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sub.category.list') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'sub.category.list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sub-Category-List</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- ------category----------- --}}

                        <!----Verticals----->
                        <li class="nav-item">
                            <a href="{{ route('vertical.list') }}"
                                class="nav-link {{ Route::currentRouteName() == 'vertical.list' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-users"></i>
                                <p>Verticals</p>
                            </a>
                        </li>
                        {{-- ------Create Plan/Post----------- --}}
                        <li
                            class="nav-item  {{ Route::currentRouteName() == 'category.list' || Route::currentRouteName() == 'view.post' || Route::currentRouteName() == 'view.hangout' ? 'menu-open' : '' }}">
                            <a href=""
                                class="nav-link {{ Route::currentRouteName() == 'category.list' || Route::currentRouteName() == 'view.post' || Route::currentRouteName() == 'view.hangout' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>Create Plan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item">
                                    <a href="{{ route('category.list') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'category.list' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Travel Plan</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('view.hangout') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'view.hangout' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Hangout</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('view.post') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'view.post' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Post</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- ------category----------- --}}

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield ("content")
        </div>
        <!-- /.content-wrapper -->

        <!------------------- Main Footer---------------- -->
        {{-- <footer class="main-footer">
        </footer> --}}
        <!------------------- Main Footer end here----------->
    </div>

    {{-- ----toster------- --}}
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: true,
                    progressBar: true
                });
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                toastr.success("{{ session('error') }}", "Error", {
                    closeButton: true,
                    progressBar: true
                });
            });
        </script>
    @endif

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap -->
    <script src="{{ asset('/admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('/admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/admin-assets/dist/js/adminlte.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('/admin-assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/admin-assets/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/admin-assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-assets/assets/js/admin.js') }}"></script>
    {{-- -------------------------------- --}}
    <!-- toastr -->

    <!-- SweetAlert2 -->
    {{-- <!-- <script src="{{ asset('/admin-assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script> --> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
