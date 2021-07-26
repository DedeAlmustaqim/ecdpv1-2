<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $judul ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>dist/img/logo_pn.png">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>dist/css/adminlte.min.css">
    <!-- Sweet-Alert  -->
    <link href="<?php echo base_url() ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    <style type="text/css">
        .login-page {
            background: url("<?php echo base_url() ?>dist/img/login.jpg") no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?php echo base_url() ?>dist/img/logo_pn.png" width="70px"><br>

            <a href="<?php echo base_url() ?>" class="text-bold"><b>ECDP V.1.0</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>
                <?php if ($this->session->flashdata('no_user')) { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <small><i class="icon fas fa-exclamation-triangle"></i>
                            <?php echo $this->session->flashdata('no_user'); ?></small>
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
                                    <input type="password" name="password" class="form-control" maxlength="16" placeholder="Password" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 text-center">
                                <?= $image; ?>
                            </div>
                            <div class="col-sm-12">
                                <input name="captcha_kode" placeholder="Captcha" class="form-control" maxlength="10" required data-validation-required-message="Tidak Boleh Kosong">
                            </div>
                            <?php if ($this->session->flashdata('cap_error')) { ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <small><i class="icon fas fa-exclamation-triangle"></i>
                                        <?php echo $this->session->flashdata('cap_error'); ?></small>
                                </div> <?php } ?>
                            <div class="help-block"></div>
                        </div>

                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info">Masuk</button>
                        </div>
                        <!-- /.card-footer -->
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>dist/js/adminlte.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="<?php echo base_url() ?>plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url() ?>plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <script src="<?php echo base_url() ?>plugins/validation.js"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
        }(window, document, jQuery);
    </script>
    <script>
        //Warning Message
        $('#SaNoUser').each(function() {
            swal({
                title: "Gagal Login",
                text: "Username/Password Salah",
                type: "warning",
                showCancelButton: false,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OKE",
                closeOnConfirm: false
            });
        });
    </script>
</body>

</html>