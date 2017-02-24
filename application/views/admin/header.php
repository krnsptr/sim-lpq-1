<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM LPQ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>font-awesome-4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>ionicons-2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css">


  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/fastclick/fastclick.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/dist/js/app.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/bootstrap/js/validator.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-green-light fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>admin" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SIM</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIM LPQ</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url().'img/'; ?>default.png" class="user-image" alt="User Image">
                <span class="hidden-xs">Administrasi</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="<?php echo base_url().'img/'; ?>default.png" class="img-circle" alt="User Image">

                  <p>
                    Administrasi
                    <small>administrasi</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <!--a href="<?php echo base_url(); ?>admin/logout" class="btn btn-default btn-flat">Logout</a-->
                  </div>
                </li>
              </ul>
            </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'img/'; ?>default.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrasi</p>
          administrasi
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li<?php if(uri_string() == 'admin/dasbor') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/dasbor'; ?>"><span>Dasbor</span></a></li>
        <li<?php if(uri_string() == 'admin/anggota') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/anggota'; ?>"><span>Anggota</span></a></li>
        <li<?php if(uri_string() == 'admin/santri') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/santri'; ?>"><span>Santri</span></a></li>
        <li<?php if(uri_string() == 'admin/pengajar') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/pengajar'; ?>"><span>Pengajar</span></a></li>
        <!--li<?php if(uri_string() == 'admin/kelompok') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/kelompok'; ?>"><span>Kelompok</span></a></li>
        <li<?php if(uri_string() == 'admin/spp') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/spp'; ?>"><span>SPP</span></a></li>
        <li<?php if(uri_string() == 'admin/download') echo ' class="active"'; ?>><a href="<?php echo base_url().'admin/download'; ?>"><span>Download</span></a></li-->
      </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>


<!-- =============================================== -->