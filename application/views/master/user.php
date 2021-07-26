<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="margin">
            <div class="btn-group">
                <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-user">+ User</button>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table id="tabel-admin" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="4%" class="text-center">NO</th>
                        <th width="17%" class="text-center">USERNAME</th>
                        <th width="23%" class="text-center">NAMA</th>
                        <th width="16%" class="text-center">NIP</th>
                        <th width="13%" class="text-center">EMAIL</th>
                        <th width="15%" class="text-center">HAK AKSES</th>
                        <th width="12%" class="text-center"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="modal-tambah-user" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body collapse show">
                        <form class="m-t-0" novalidate="" id="form-tambah-user" method="post">
                            <div class="form-group">
                                <h5>Username <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="username" id="username" maxlength="25" minlength="8" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nm_user" id="nm_user" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>NIP <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nip_user" id="nip_user" minlength="18" maxlength="19" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Hanya Angka" area-invalid="false">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email_user" id="email_user" class="form-control"  required="" data-validation-required-message="Tidak Boleh Kosong" >
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                            <h5>Hak Akses <span class="text-danger">*</span></h5>

                                <select name="hak_akses" id="hak_akses" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="2">Admin PN</option>
                                    <option value="3">Verifikator</option>
                                    <option value="5">Kejaksaan</option>

                                </select>
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


<div id="modal-edit-user" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body collapse show">
                        <form class="m-t-0" novalidate="" id="form-edit-user" method="post">
                            
                        <input type="text"  name="id_user" id="id_user" maxlength="25" minlength="8" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <h5>Username <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="username_edit" id="username_edit" maxlength="25" minlength="8" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Nama <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nm_user_edit" id="nm_user_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>NIP <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="nip_user_edit" id="nip_user_edit" minlength="19" maxlength="18" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="Hanya Angka" area-invalid="false">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Email <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="email" name="email_user_edit" id="email_user_edit" class="form-control"  required="" data-validation-required-message="Tidak Boleh Kosong" >
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                            <h5>Hak Akses <span class="text-danger">*</span></h5>

                                <select name="hak_akses_edit" id="hak_akses_edit" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="2">Admin PN</option>
                                    <option value="3">Verifikator</option>
                                    <option value="5">Kejaksaan</option>

                                </select>
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
                                            <input type="text" name="nip_op" id="nip_op" maxlength="18" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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