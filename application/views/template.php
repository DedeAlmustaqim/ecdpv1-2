<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/logo_pn.png">
  <!-- Favicon icon -->
  <title><?php echo $judul ?></title>
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/libs/toastr/build/toastr.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>assets/libs/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <!-- This Page CSS -->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  <style type="text/css">
    .ajaxload {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }

    .ajaxload .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font: 14px arial;
    }
  </style>
  <style>
    table.dataTable tbody th,
    table.dataTable tbody td {
      padding: 8px 10px;
      /* e.g. change 8x to 4px here */
    }

    .dataTables_wrapper .dataTables_filter {
      float: right;
      text-align: right;
      visibility: hidden;
    }

    @media (min-width: 1200px) {
      .modal-xl {
        width: 90%;
      }
    }
  </style>
</head>

<body>

  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>

  <div class="ajaxload">
    <div class="loading">
      <img src="<?php echo base_url() ?>/assets/images/ajax-loader.gif" width="80">
      <p>Harap Tunggu</p>
    </div>
  </div>


  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
            <i class="ti-menu ti-close"></i>
          </a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-brand">
            <a href="index.html" class="logo">
              <!-- Logo icon -->
              <b class="logo-icon">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img src="<?php echo base_url() ?>assets/images/logo_pn.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo icon -->
                <img src="<?php echo base_url() ?>assets/images/logo_pn.png" alt="homepage" class="light-logo" width="30px" />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->


              </span>
            </a>
            <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
              <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti-more"></i>
          </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-left mr-auto">
            <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <li class="nav-item search-box">
              <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                ECDP V.1.1
              </a>

            </li>
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-right">
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="m-l-5 font-medium d-none d-sm-inline-block">
                  <?php echo $this->session->userdata('hak_akses') ?>
                  <i class="mdi mdi-chevron-down"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <span class="with-arrow">
                  <span class="bg-primary"></span>
                </span>
                <div class="d-flex no-block align-items-center p-15 bg-info text-white m-b-10">

                  <div class="m-l-10">
                    <h4 class="m-b-0">
                      <?php echo $this->session->userdata('ses_nm') ?><br>
                    </h4>
                  </div>
                </div>
                <div class="profile-dis scrollable">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalUbahPass">
                    <i class="fas fa-key"></i> Ubah Password</a>
                  <a class="dropdown-item" href="<?php echo base_url() ?>login/logout">
                    <i class="m-r-10 mdi mdi-login-variant"></i> Logout</a>

                </div>

              </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('dashboard') ?>" aria-expanded="false"><i class="m-r-10 mdi mdi-home"></i><span class="hide-menu">Dashboard</span></a></li>
            <?php if ($this->session->userdata('akses') != 4) { ?>
              <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Master</span></a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item"><a href="<?php echo base_url('user') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">User</span></a></li>
                  <li class="sidebar-item"><a href="<?php echo base_url('master/unit') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Unit</span></a></li>
                </ul>
              </li>
            <?php } ?>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Penggeledahan</span></a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="<?php echo base_url('penyelidikan') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Penyelidikan</span></a></li>
                <li class="sidebar-item"><a href="<?php echo base_url('penyidikan') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Penyidikan</span></a></li>
              </ul>
            </li>
            <!-- Menu Penyitaan -->
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Penyitaan</span></a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="<?php echo base_url('ijinsita_p') ?>" class="sidebar-link text font-12"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Ijin Sita </span>&nbsp;<span class="badge badge-pill badge-info">Penyelidikan</span></a></li>
                <li class="sidebar-item"><a href="<?php echo base_url('psita_p') ?>" class="sidebar-link font-12"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Persetujuan Sita&nbsp;<span class="badge badge-pill badge-info">Penyelidikan</span></span></a></li>
                <li class="sidebar-item"><a href="<?php echo base_url('ijinsita') ?>" class="sidebar-link font-12"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Ijin Sita </span>&nbsp;<span class="badge badge-pill badge-warning">Penyidikan</span></a></li>
                <li class="sidebar-item"><a href="<?php echo base_url('psita') ?>" class="sidebar-link font-12"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Persetujuan Sita&nbsp;<span class="badge badge-pill badge-warning">Penyidikan</span></span></a></li>
              </ul>
            </li>
            <!-- ----------------- -->
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Penahanan</span></a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item"><a href="<?php echo base_url('penahanan') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Penyidikan</span></a></li>
                <li class="sidebar-item"><a href="<?php echo base_url('penahanan_p') ?>" class="sidebar-link"><i class="m-r-10 mdi mdi-arrow-right"></i><span class="hide-menu">Penuntutan</span></a></li>
              </ul>
              
            </li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('penyadapan') ?>" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Penyadapan</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('penuntutan') ?>" aria-expanded="false"><i class="m-r-10 mdi mdi-reorder-horizontal"></i><span class="hide-menu">Limpah Perkara</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('login/logout') ?>" aria-expanded="false"><i class="m-r-10 mdi mdi-login-variant"></i><span class="hide-menu">Logout</span></a></li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" style="background-image: url('<?php echo base_url()?>assets/images/form-login.jpg'); background-repeat: no-repeat;  background-size: 100% 100%;">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row" >
          <div class="col-12 align-self-center">
            <div class="d-flex align-items-center justify-content-start">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page"><?php echo $judul ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <?php echo $konten ?>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center">
        ECDP V.1.1 <br>
        &copy;&nbsp;Pengadilan Negeri Tamiang Layang
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <div class="modal fade bs-example-modal-lg" id="ModalBtNav" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Menu Bantuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table id="tabel-bt-nav" class="table table-bordered font-16" width="100%">
            </table>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade bs-example-modal-lg" id="ModalUbahPass" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myLargeModalLabel">Ubah Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" novalidate id="FormUbahPass">
            <div class="card-body">
              <div class="form-group row">
                <label for="fname" class="col-sm-3 text-left control-label col-form-label">Password Baru</label>
                <div class="col-sm-5">
                  <div class="controls">
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" id="pass" name="pass" placeholder="Minimal 8 Karakter" required minlength="8" maxlength="20" data-validation-required-message="Tidak Boleh Kosong">
                      <div class="input-group-append">
                        <span class="input-group-text pass"> <i class="fas fa-eye"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="fname" class="col-sm-3 text-left control-label col-form-label">Ulangi Password</label>
                <div class="col-sm-5">
                  <div class="controls">
                    <div class="input-group mb-3">
                      <input type="password" name="pass2" id="pass2" data-validation-match-match="pass" class="form-control" data-validation-required-message="Tidak Boleh Kosong" required="" aria-invalid="false">
                      <div class="input-group-append">
                        <span class="input-group-text pass2"> <i class="fas fa-eye"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="form-group m-b-0 text-center">
                  <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                  <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Batal</button>
                </div>
              </div>
          </form>
        </div>

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- Image loader -->

  <!-- Image loader -->

  <!-- ============================================================== -->
  <!-- End Wrapper -->
  <!-- ============================================================== -->

  <div class="chat-windows"></div>
  <!-- ============================================================== -->
  <!-- All Jquery -->
  <!-- ============================================================== -->
  <script>
    var BASE_URL = "<?php echo base_url() ?>"
    var unit = "<?php echo $this->uri->segment(3) ?>";
    var bantuan = "<?php echo $this->uri->segment(4) ?>";
    var AKSES = "<?php echo $this->session->userdata('akses') ?>"
  </script>

  <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- apps -->
  <script src="<?php echo base_url() ?>dist/js/app.min.js"></script>
  <script src="<?php echo base_url() ?>dist/js/app.init.mini-sidebar.js"></script>
  <script src="<?php echo base_url() ?>dist/js/app-style-switcher.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="<?php echo base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="<?php echo base_url() ?>dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="<?php echo base_url() ?>dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="<?php echo base_url() ?>dist/js/custom.min.js"></script>
  <!--This page plugins -->
  <script src="<?php echo base_url() ?>assets/extra-libs/DataTables/datatables.min.js"></script>
  <!-- JS APLIKASI -->
  <script src="<?php echo base_url() ?>assets/ecdp.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/gd.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/py.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/ijinsita_p.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/ijinsita.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/psita_p.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/psita.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/master.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/penahanan.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/penahanan_p.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/penuntutan.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/pd.js?v=<?php echo date('YmdHis') ?>"></script>
  <script src="<?php echo base_url() ?>assets/validation.js"></script>
  <!-- ------------------------------------ -->
  <script src="<?php echo base_url() ?>assets/libs/toastr/build/toastr.min.js"></script>
  <script src="<?php echo base_url() ?>assets/libs/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo base_url() ?>assets/libs/sweetalert/jquery.sweet-alert.custom.js"></script>
  <!-- <script src="<?php echo base_url() ?>dist/js/pages/chartjs/chartjs.init.js"></script> -->
  <script src="<?php echo base_url() ?>assets/libs/Chart.js/dist/Chart.min.js"></script>



  \
  <script>
    ! function(window, document, $) {
      "use strict";
      $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
        checkboxClass: "icheckbox_square-green",
        radioClass: "iradio_square-green"
      }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
    }(window, document, jQuery);
    $(window).load(function() {
      $(".loader").fadeOut("slow");
    });
  </script>

  <script>
    $('.pass').hover(function() {
      $('#pass').attr('type', 'text');
    }, function() {
      $('#pass').attr('type', 'password');
    });

    $('.pass2').hover(function() {
      $('#pass2').attr('type', 'text');
    }, function() {
      $('#pass2').attr('type', 'password');
    });
  </script>


</body>

</html>