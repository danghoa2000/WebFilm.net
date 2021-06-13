<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{__('Admin')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
@include('sweetalert::alert')

<div class="wrapper">
    <div id="preloder">
        <div class="loader"></div>
    </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    @yield('search')

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <div>
        <a class="btn btn-block btn-secondary btn-sm" style="margin-top: 5px;display block" href="{{ route('logout') }}">{{__('Logout')}}</a>
      </div>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="">
          <i id="language" class="flag-icon flag-icon-us"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right p-0">
          <a href="{{route('change-language','')}}/en" class="dropdown-item">
            <i class="flag-icon flag-icon-us mr-2"></i> English
          </a>
          <a href="{{route('change-language','')}}/vi" class="dropdown-item">
            <i class="flag-icon flag-icon-vn mr-2"></i> Tiếng việt
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{__('Admin')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if (Auth::guard('admin')->user()->avatar == null)
                <img src="{{ asset('img/user/profile_none.png')}}" class="img-circle elevation-2" style="height: 2.1rem;" alt="User Image">
            @else
                <img src="{{ asset(Auth::guard('admin')->user()->avatar)}}" class="img-circle elevation-2" style="height: 2.1rem;" alt="User Image">
            @endif
        </div>
        <div class="info" style="width: 180px; overflow: hidden;">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview" id="master_Home">
                <a href="{{route('admin_index')}}" id="home" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('Profile')}}
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview" id="master_film">
                <a href="#" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('Film')}}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="film_index">
                    <li class="nav-item">
                        <a href="{{route('film_index')}}" id="film" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Index')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="film_Create">
                        <a href="{{route('film_create')}}" id="CreateFilm" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Create Film')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="film_edit" style="opacity: 0.4">
                        <a href="#" id="EditFilm" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Edit Film')}}
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview" id="master_episode">
                <a href="#" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('Episode')}}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="episode_index">
                    <li class="nav-item">
                        <a href="#" id="episode" class="nav-link" style="opacity: 0.4">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Index')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="episode_Create"  style="opacity: 0.4">
                        <a href="#" id="episodeCreate" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Create Episode')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="episode_edit" style="opacity: 0.4">
                        <a href="#" id="episodeEdit" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Edit Episode')}}
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview" id="master_category">
                <a href="#" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('Category')}}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="category_index">
                    <li class="nav-item">
                        <a href="{{route('category_index')}}" id="category" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Index')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="category_Create"  style="opacity: 0.4">
                        <a href="#" id="categoryCreate" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Create Category')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item" id="category_edit" style="opacity: 0.4">
                        <a href="#" id="categoryEdit" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Edit Category')}}
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview" id="master_user">
                <a href="#" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('User')}}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="user_index">
                    <li class="nav-item">
                        <a href="{{route('user_index')}}" id="user" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Index')}}
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview" id="master_statistical">
                <a href="#" class="nav-link" >
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                    {{__('Statistical')}}
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" id="statistical_index">
                    <li class="nav-item">
                        <a href="{{route('statistical_index')}}" id="statistical" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('Chart')}}
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('statistical_list')}}" id="statistical_list" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            {{__('List')}}
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/admin/popper.min.js')}}"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->

<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('AdminLTE-3.0.5/AdminLTE-3.0.5/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
<script  src = " https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js " > </script>
@yield('js')
<script src="{{ asset('js/admin/myJs/master.js')}}"></script>
</body>
</html>
