<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Track laundry</title>

  
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  @yield('addCss')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark-primary elevation-4" style="background-color: #003366;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #ffffff;"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin" class="nav-link" style="color: #ffffff;">Home</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt" style="color: #ffffff;"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #003366;">
  <!-- Brand Logo -->
  <a href="" class="brand-link" style="background-color: #336699; color: #ffffff;">
    <img src="img/logo_laundry.png" alt="" class="brand-image img-circle" style="opacity: 0.8;">
    <span class="brand-text font-weight-light">{{ $title ?? "TRACK LAUNDRY" }}</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active" style="background-color: #336699; color: #ffffff;">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              Menu
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">              
            <li class="nav-item">
              <a href="{{ route('listCategory') }}" class="nav-link {{ Request::routeIs('listCategory') ? 'active' : '' }}" style="{{ Request::routeIs('listCategory') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-tshirt"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listCustomer') }}" class="nav-link {{ Request::routeIs('listCustomer') ? 'active' : '' }}" style="{{ Request::routeIs('listCustomer') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('listEmployees') }}" class="nav-link {{ Request::routeIs('listEmployees') ? 'active' : '' }}" style="{{ Request::routeIs('listEmployees') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-pen"></i>
                <p>Employee</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link {{ Request::routeIs('order') ? 'active' : '' }}" style="{{ Request::routeIs('order') ? 'color: #000000;' : 'color: #ffffff;' }}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Order</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link" style="background-color: #336699; color: #ffffff;">
            <i class="fas fa-sign-out-alt"></i> 
            <p>              
              Logout
            </p>
          </a>
          <form id="logout-form" action="/logout" method="POST" class="d-none">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
@yield('content')

<!-- REQUIRED SCRIPTS -->
{{-- @include('sweetalert::alert') --}}
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
@yield('addJavascript')
</body>
</html>
