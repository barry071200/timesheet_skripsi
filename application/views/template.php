<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TIMESHEET</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.min.css">
  <script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="https://www.cokal.com.au/" class="nav-link">Information</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
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

        <!-- Messages Dropdown Menu -->


        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>assets/index3.html" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/Cokal.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TIMESHEET</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $this->session->userdata('username'); ?> Sedang Login</p></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="<?php echo site_url('dashboard') ?>" class="nav-link">
                <i class="bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>

            </li>
            <?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '5') { ?>
              <li class="nav-item">
                <a href="<?php echo site_url('timesheet') ?>" class="nav-link">
                  <i class="fa fa-edit"></i>
                  <p>Timesheet</p>
                </a>
              <?php } ?>
              </li>
              <?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4' or $this->session->userdata('role') == '5' or $this->session->userdata('role') == '3') { ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('karyawan') ?>" class="nav-link">
                    <i class="bi bi-people-fill"></i>
                    <p>Karyawan</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($this->session->userdata('role') == '1' or $this->session->userdata('role') == '4' or $this->session->userdata('role') == '5' or $this->session->userdata('role') == '3') { ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('unit') ?>" class="nav-link">
                    <i class="bi bi-list-task"></i>
                    <p>Unit</p>
                  </a>
                </li>

              <?php } ?>
              <?php if ($this->session->userdata('role') == '3') { ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('supervisor') ?>" class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    <p>Validasi</p>
                  </a>
                </li>
              <?php } ?>

              </li>
              <?php if ($this->session->userdata('role') == '1') { ?>
                <li class="nav-item">
                  <a href="<?php echo site_url('Pengguna') ?>" class="nav-link">
                    <i class="bi bi-person-plus"></i>
                    <p>Pengguna</p>
                  </a>
                <?php } ?>

                </li>

                <li class="nav-item">
                  <a href="<?php echo site_url('login/logout') ?>" class="nav-link">
                    <i class="bi bi-box-arrow-left"></i>
                    <p>logout</p>
                  </a>
                </li>

                </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo $judul; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $judul; ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <?php $this->load->view($layout); ?>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Albertus C.P</b>
      </div>
      <strong>Copyright &copy; Albertus Cahaya Putra.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->

  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!--<script src="<?= base_url() ?>assets/dist/js/demo.js"></script> -->


</body>

</html>