<div class="row" >


    <div class="col-lg-12 col-md-12">

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            <h3 class="text-info"><i class="fa fa-exclamation-circle"></i> Information</h3> Selamat Datang di Aplikasi ECDP <?php echo $this->session->userdata('ses_nm')?>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div class="m-l-15 m-t-0">

                        <h4 class="font-medium m-b-0"> <span class="text-info display-6"><i class="ti-clipboard"></i></span>
                            PENGGELEDAHAN</h4><br>

                        <a type="button" href="<?php echo base_url() ?>penyelidikan" class="btn waves-effect waves-light btn-info">Penyelidikan</a>
                        <a type="button" href="<?php echo base_url() ?>penyidikan" class="btn waves-effect waves-light btn-info">Penyidikan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div class="m-l-15 m-t-0">
                        <h4 class="font-medium m-b-0"><span class="text-info display-6"><i class="ti-clipboard"></i></span>PENYITAAN <span class="badge badge-pill badge-info">Penyelidikan</span> </h4><br>
                        <a type="button" href="<?php echo base_url() ?>ijinsita_p" class="btn waves-effect waves-light btn-info">Ijin Sita</a>
                        <a type="button" href="<?php echo base_url() ?>psita_p" class="btn waves-effect waves-light btn-info">Persetujuan Sita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div class="m-l-15 m-t-0">
                        <h4 class="font-medium m-b-0"><span class="text-info display-6"><i class="ti-clipboard"></i></span>PENYITAAN <span class="badge badge-pill badge-warning ">Penyidikan</span> </h4><br>
                        <a type="button" href="<?php echo base_url() ?>ijinsita" class="btn waves-effect waves-light btn-info">Ijin Sita</a>
                        <a type="button" href="<?php echo base_url() ?>psita" class="btn waves-effect waves-light btn-info">Persetujuan Sita</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div class="m-l-15 m-t-0">
                        <h4 class="font-medium m-b-0"><span class="text-info display-6"><i class="ti-clipboard"></i></span>PENAHANAN</h4><br>
                        <a type="button" href="<?php echo base_url() ?>penahanan" class="btn waves-effect waves-light btn-info">Penyidikan</a>
                        <a type="button" href="<?php echo base_url() ?>penahanan_p" class="btn waves-effect waves-light btn-info">Penuntutan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card bg-white">
            <div class="card-body">
                <div class="d-flex no-block align-items-center">
                    <div class="m-l-15 m-t-0">
                        <h4 class="font-medium m-b-0"><span class="text-info display-6"><i class="ti-clipboard"></i></span>PENYADAPAN </h4><br>
                        <a type="button" href="<?php echo base_url() ?>penyadapan" class="btn waves-effect waves-light btn-info">Penyadapan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>