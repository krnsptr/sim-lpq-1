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

  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/plugins/fastclick/fastclick.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/dist/js/app.min.js"></script>
  <script src="<?php echo base_url().'assets/'; ?>AdminLTE-2.3.11/bootstrap/js/validator.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green-light layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo site_url(); ?>" class="navbar-brand"><b>SIM LPQ</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li<?php if(uri_string() == 'user/dasbor') echo ' class="active"'; ?>><a href="<?php echo base_url(); ?>user/dasbor">Dasbor</a></li>
            <li<?php if(uri_string() == 'user/penjadwalan') echo ' class="active"'; ?>><a href="<?php echo site_url('user/penjadwalan'); ?>">Penjadwalan</a></li>
            <!--li<?php if(uri_string() == 'user/kelompok') echo ' class="active"'; ?>><a href="<?php echo site_url('user/kelompok'); ?>">Kelompok</a></li>
            <li<?php if(uri_string() == 'user/spp') echo ' class="active"'; ?>><a href="<?php echo site_url('user/spp'); ?>">SPP</a></li>
            <li<?php if(uri_string() == 'user/jadwal-kbm') echo ' class="active"'; ?>><a href="<?php echo site_url('jadwal-kbm'); ?>">Jadwal KBM</a></li-->
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url().'img/'; ?>default.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo html_escape($anggota->nama_lengkap); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url().'img/'; ?>default.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo html_escape($anggota->nama_lengkap); ?>
                    <small><?php echo html_escape($anggota->nomor_id); ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('user/akun'); ?>" class="btn btn-default btn-flat">Akun</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('user/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>