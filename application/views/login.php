<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/favicon.png">
    <title>ECDV V.1.1</title>
    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body style="background-image: url('<?php echo base_url()?>assets/images/bg-pn.jpg'); background-repeat: no-repeat;  background-size: 100% 100%;" >
    <div class="main-wrapper" >
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center">
            <div class="auth-box" style="background-image: url('<?php echo base_url()?>assets/images/form-login.jpg'); background-repeat: no-repeat;  background-size: 100% 100%;">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="<?php echo base_url() ?>assets/images/logo_pn.png" alt="logo" width="100px" /></span>
                        <p></p>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                            <h2 class="text-center"><b>ECDP</b></h2>
                            <h4 class="font-medium text-center">Electronic Crime Document Process</h4>
                            <h6 class="font-medium text-center">(Administrasi Berkas Pidana Secara Elektronik)</h6>
                            <h6 class="font-medium text-center">Versi 1.1.25032021</h6>

                                <?php if ($this->session->flashdata('no_user')) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <small><i class="icon fas fa-exclamation-triangle"></i>
                                            <?php echo $this->session->flashdata('no_user'); ?></small>
                                    </div> <?php } ?>
                                <?php if ($this->session->flashdata('cap_error')) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <small><i class="icon fas fa-exclamation-triangle"></i>
                                            <?php echo $this->session->flashdata('cap_error'); ?></small>
                                    </div> <?php } ?>
                                <form class="form-horizontal" action="<?php echo base_url() ?>login/auth" method="post" novalidate="">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-12">

                                                <div class="controls">
                                                    <input type="text" name="username" class="form-control" maxlength="16" placeholder="Username" required="" data-validation-required-message="Tidak Boleh Kosong">
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <div class="controls">
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required minlength="8" maxlength="20" data-validation-required-message="Tidak Boleh Kosong">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text pass-login"> <i class="fas fa-eye"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 text-center">
                                                <?= $image; ?><br><br>
                                            </div>
                                            <div class="col-sm-12">
                                                <input name="captcha_kode" placeholder="Captcha" class="form-control" maxlength="10" required data-validation-required-message="Tidak Boleh Kosong">
                                            </div>

                                            <div class="help-block"></div>
                                        </div>

                                        <!-- /.card-body -->
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-info">Masuk</button>
                                        </div>
                                        <!-- /.card-footer -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/validation.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $('[data-toggle="tooltip"]').tooltip();
        $(".preloader").fadeOut();
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
    <script>
    $('.pass-login').hover(function() {
      $('#password').attr('type', 'text');
    }, function() {
      $('#password').attr('type', 'password');
    });

   
  </script>
</body>

</html>