<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="margin">
            <div class="btn-group">
                <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-unit">+ Unit</button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table id="tabel-unit" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">NO</th>
                        <th width="25%" class="text-center">NAMA UNIT</th>
                        <th width="25%" class="text-center">NAMA PIMPINAN</th>
                        <th width="25%" class="text-center">NRP/NIP</th>
                        <th width="10%" class="text-center"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="modal-tambah-unit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body collapse show">
                        <form class="m-t-0" novalidate="" id="form-tambah-unit" method="post">
                            <div class="form-group">
                                <h5>Nama Unit <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nm_unit" id="nm_unit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama Pimpinan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nm_pimpinan" id="nm_pimpinan" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>NRP/NIP <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nrp_nip" id="nrp_nip" class="form-control" maxlength="18"  required="" data-validation-required-message="Tidak Boleh Kosong" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Hanya Angka" area-invalid="false">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div id="modal-edit-unit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Unit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body collapse show">
                        <form class="m-t-0" novalidate="" id="form-edit-unit" method="post">
                            <div class="form-group">
                                <h5>Nama Unit <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text"  name="id_unit" id="id_unit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <input type="text" name="nm_unit_edit" id="nm_unit_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama Pimpinan <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nm_pimpinan_edit" id="nm_pimpinan_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>NRP/NIP <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nrp_nip_edit" id="nrp_nip_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Hanya Angka" area-invalid="false">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<div id="modal-set-op" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">TAMBAH OPERATOR <span id="nm-unit"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body collapse show">
                        <div id="tambah-op"></div>
                        <br>
                        <div class="table-responsive">
                            <table id="tabel-set-op" class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th width="2%" class="text-center">No</th>
                                        <th class="text-center">USERNAME</th>
                                        <th class="text-center">NAMA</th>
                                        <th class="text-center">NIP/NRP</th>
                                        <th class="text-center">EMAIL</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <hr>
                        <div class="text-center">

                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- MODAL BARANG DATA -->
<div id="modal-tambah-op" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Operator </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form class="m-t-40" novalidate="" enctype="multipart/form-data" id="form-tambah-op" method="post">
                            <div class="form-group">
                                <div class="controls">
                                    <input hidden type="text" name="id_unit_op" id="id_unit_op" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Username <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="username_op" id="username_op" class="form-control" required="" minlength="6" maxlength="25" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="nama_op" id="nama_op" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>NIP/NRP <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="nip_op" id="nip_op"  maxlength="18" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Email <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="email" name="email_op" id="email_op" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>