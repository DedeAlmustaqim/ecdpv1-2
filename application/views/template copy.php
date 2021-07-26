<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>dist/img/logo_pn.png">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plugins/pickadate/lib/themes/default.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plugins/pickadate/lib/themes/default.date.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>plugins/pickadate/lib/themes/default.time.css">
  <!-- Custom CSS -->
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/dropzone/dropzone.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="<?php echo base_url() ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <style>
    /*******************
Preloader
********************/

    .preloader {
      width: 100%;
      height: 100%;
      top: 0px;
      position: fixed;
      z-index: 99999;
      background: #fff;
    }

    .lds-ripple {
      display: inline-block;
      position: relative;
      width: 64px;
      height: 64px;
      position: absolute;
      top: calc(50% - 3.5px);
      left: calc(50% - 3.5px);
    }

    .lds-ripple .lds-pos {
      position: absolute;
      border: 2px solid #2962FF;
      opacity: 1;
      border-radius: 50%;
      animation: lds-ripple 1s cubic-bezier(0, 0.1, 0.5, 1) infinite;
    }

    .lds-ripple .lds-pos:nth-child(2) {
      animation-delay: -0.5s;
    }

    @keyframes lds-ripple {
      0% {
        top: 28px;
        left: 28px;
        width: 0;
        height: 0;
        opacity: 0;
      }

      5% {
        top: 28px;
        left: 28px;
        width: 0;
        height: 0;
        opacity: 1;
      }

      100% {
        top: -1px;
        left: -1px;
        width: 58px;
        height: 58px;
        opacity: 0;
      }
    }
  </style>

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">

  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-green navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <div id="nav"></div>
        </li>

      </ul>

      <!-- SEARCH FORM -->


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link text-white" data-toggle="dropdown" href="#">
            <?php if ($this->session->userdata('akses') == 4) { ?>
              <i class="fa fa-user">&nbsp;</i> <?php echo $this->session->userdata('ses_nm_unit') ?>
            <?php } else { ?>

              <i class="fa fa-user">&nbsp;</i> <?php echo $this->session->userdata('hak_akses') ?>

            <?php } ?>
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-secondary elevation-4 ">
      <div id="title"></div>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

          <div class="info">
            <a href="#" class="d-block"><?php echo $this->session->userdata('ses_nm') ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
              <a href="<?php echo base_url() ?>dashboard" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Dashboard
                </p>
              </a>

            </li>
            <?php
            if (($this->session->userdata('akses') == '1') || ($this->session->userdata('akses') == '2')) { ?>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Master Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" onclick="SaProses()" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>master/unit" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Unit</p>
                    </a>
                  </li>

                </ul>
              </li>
            <?php
            }
            ?>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Penggeledahan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>penyelidikan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyelidikan</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>penyidikan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penyidikan</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Penyitaan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>ijinsita" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ijin Sita</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>psita" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Persetujuan Sita</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Penahanan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo base_url() ?>penahanan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Perpanjangan Penahanan</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="<?php echo base_url() ?>penyadapan" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Penyadapan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

            </li>
            <li class="nav-item has-treeview">
              <a href="<?php echo base_url() ?>login/logout" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Logout
                </p>
              </a>

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
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                <li class="breadcrumb-item active"><?php echo $judul ?></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">

        <div class="container-fluid">
          <?php echo $konten ?>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->


    </div> <!-- ./wrapper -->


    <script type="text/javascript">
      var BASE_URL = "<?php echo base_url() ?>";
    </script>
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url() ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url() ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url() ?>plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url() ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url() ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url() ?>plugins/jquery-knob/jquery.knob.min.js"></script>


    <!-- Summernote -->
    <script src="<?php echo base_url() ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url() ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url() ?>dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>dist/js/demo.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/gd.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/py.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/ijinsita.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/psita.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/master.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/penahanan.js?n=1"></script>
    <script src="<?php echo base_url() ?>plugins/pd.js?n=1"></script>

    <script src="<?php echo base_url() ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url() ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url() ?>plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <script src="<?php echo base_url() ?>plugins/dropzone/dropzone.js"></script>
    <script src="<?php echo base_url() ?>plugins/validation.js"></script>
    <script src="<?php echo base_url() ?>plugins/ecdp.js"></script>


    <!-- ChartJS -->
    <!-- ChartJS -->
    <script src="<?php echo base_url() ?>plugins/chart.js/Chart.min.js"></script> <!-- Select2 -->
    <!-- Toastr -->
    <script src="<?php echo base_url() ?>plugins/toastr/toastr.min.js"></script>
    <script>
      var AKSES = "<?php echo $this->session->userdata('akses') ?>";
    </script>
   
</body>

</html>