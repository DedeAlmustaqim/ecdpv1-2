<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?> <span class="badge badge-pill badge-warning">Penyidikan</span></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="btn-group">
                    <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-st">+ TAMBAH</button>
                </div>
            </div>
            <div class="col-6">
                <h3 class="m-0  text-center"><?php echo $judul ?> <span class="badge badge-pill badge-warning">Penyidikan</span></h3>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    FILTER DATA
                </div>
            </div>
            <div class="col-sm-2">
                <!-- select -->
                <div class="form-group">
                    <select id="filter-table-st" class="form-control">
                        <option value="">Semua</option>
                        <option value="Terdaftar">Terdaftar</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>

                    </select>
                </div>
            </div>
        </div>
        <hr>

        <div class="table-responsive">
            <table id="tabel-ijinsita" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="2%" class="text-center">NO</th>
                        <th class="text-center" width="17%">NO SURAT PERMOHONAN</th>
                        <th width="13%" class="text-center">UNIT</th>
                        <th class="text-center" width="10%">BARANG SITAAN</th>
                        <th class="text-center" width="25%">DOKUMEN PENDUKUNG</th>
                        <th class="text-center" width="20%">IJIN SITA</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id="modal-brg-ijinsita" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">BARANG SITAAN <span id="nm-unit"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">??</button>
            </div>
            <div class="modal-body">
                <div id="tambah-brg"></div>
                <br>
                <div class="table-responsive">
                    <table id="tabel-brg-sita" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="2%" class="text-center">No</th>
                                <th class="text-center">BARANG</th>
                                <th class="text-center">JUMLAH</th>
                                <th class="text-center">LOKASI SITA</th>
                                <th class="text-center">PELAKSANA SITA</th>
                                <th class="text-center">PEMILIK/TERSITA</th>
                                <th class="text-center">KETERANGAN</th>
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- MODAL BARANG DATA -->
<div id="modal-tambah-brg" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-secondary">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Barang Sitaan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-brg" method="post">
                            <div class="form-group">
                                <div class="controls">
                                    <input type="text" hidden name="id_ijin_sita" id="id_ijin_sita" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama Barang <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="nm_brg" id="nm_brg" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jumlah <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-2">
                                        <div class="controls">
                                            <input type="text" name="jml" id="jml" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Lokasi Sita <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="lokasi_sita" id="lokasi_sita" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pelaksana Sita <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="plk_sita" id="plk_sita" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pemilik/Tersita <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="pemilik" id="pemilik" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Keterangan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="ket" id="ket" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<!-- MODAL TAMBAH IJIN SITA -->
<div id="modal-tambah-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Surat Permohonan Ijin Sita <span class="badge badge-pill badge-warning">Penyidikan</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-st" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" placeholder="No Surat" name="no_smohon_sita" id="no_smohon_sita" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($this->session->userdata('akses') != 4) { ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Unit <span class="text-danger">*</span></label>

                                        </div>
                                        <div class="col-5">
                                            <div class="controls">
                                                <select name="unit_st" id="unit_st" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                    <option value="">-- Pilih --</option>
                                                    <?php foreach ($unit as $u) { ?>
                                                        <option value="<?php echo $u->id_unit ?>"><?php echo $u->nm_unit ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($this->session->userdata('akses') == 4) { ?>
                                <input type="text" hidden name="unit_st" id="unit_st" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>

                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan Ijin Sita </label>
                                <input type="file" class="form-control" id="edoc_st1" name="edoc_st1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc_st2" name="edoc_st2" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>
                                <input type="file" class="form-control" id="edoc_st3" name="edoc_st3" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc SPDP</label>
                                <input type="file" class="form-control" id="edoc_st5" name="edoc_st5" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Perintah </label>
                                <input type="file" class="form-control" id="edoc_st4" name="edoc_st4" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h4 class="text-danger text-bold">Disclaimer</h4>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disclaimerSt">
                                            <label class="form-check-label">Saya menyatakan bahwa data yang saya Entry bersifat benar dan dapat dipertanggungjawabkan</label>
                                        </div>
                                    </div>
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
    </div>
</div>

<!-- MODAL EDIT IJIN SITA -->
<div id="modal-edit-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Surat Permohonan Ijin Sita <span class="badge badge-pill badge-warning">Penyidikan</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edit-st" method="post">
                            <input type="text" hidden name="id_ijin_sita_edit" id="id_ijin_sita_edit" value="" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                            <input type="text" hidden name="validasi_st" id="validasi_st" value="" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_smohon_sita_edit" id="no_smohon_sita_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($this->session->userdata('akses') != 4) { ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>Unit <span class="text-danger">*</span></label>

                                        </div>
                                        <div class="col-5">
                                            <div class="controls">
                                                <select name="unit_st_edit" id="unit_st_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                    <option value="">-- Pilih --</option>
                                                    <?php foreach ($unit as $u) { ?>
                                                        <option value="<?php echo $u->id_unit ?>"><?php echo $u->nm_unit ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else if ($this->session->userdata('akses') == 4) { ?>
                                <input type="text" hidden name="unit_st_edit" id="unit_st_edit" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>


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
    </div>
</div>

<!-- MODAL DETAIL DATA PENYELIDIKAN -->
<div id="modal-detail-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Ijin Sita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Data Ijin Sita</th>


                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="40%">No. Surat Permohonan</td>
                                    <td>
                                        <div id="d1"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Unit</td>
                                    <td>
                                        <div id="d2"></div>
                                    </td>

                                </tr>

                                <tr>
                                    <td>E-Doc Surat Permohonan</td>
                                    <td>
                                        <div id="d3"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc LP/LI/LM</td>
                                    <td>
                                        <div id="d4"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Penetapan Tersangka</td>
                                    <td>
                                        <div id="d5"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc SPDP</td>
                                    <td>
                                        <div id="d5b"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Surat Perintah</td>
                                    <td>
                                        <div id="d6"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="text-center">
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT reupload surat permohonan -->
<div id="modal-reupload-smohon-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reupload E-Doc Surat Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc1-st" method="post">

                            <input type="text" hidden name="id_edoc1" id="id_edoc1" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc1_st_edit" name="edoc1_st_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
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

<!-- MODAL EDIT reupload laporan polisi/intel -->
<div id="modal-reupload-lappolintel-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reupload E-Doc LP/LI/LM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc2-st" method="post">

                            <input type="text" hidden name="id_edoc2" id="id_edoc2" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc2_st_edit" name="edoc2_st_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
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

<!-- MODAL EDIT reupload penetapan -->
<div id="modal-reupload-penetapan-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reupload E-Doc Penetapan Tersangka</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc3-st" method="post">

                            <input type="text" hidden name="id_edoc3" id="id_edoc3" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>
                                <input type="file" class="form-control" id="edoc3_st_edit" name="edoc3_st_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
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

<!-- MODAL EDIT reupload surat perintah -->
<div id="modal-reupload-sp-st" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reupload E-Doc Surat Perintah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc4-st" method="post">
                            <input type="text" hidden name="id_edoc4" id="id_edoc4" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat PErintah</label>
                                <input type="file" class="form-control" id="edoc4_st_edit" name="edoc4_st_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
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


<div id="modal-verif-sita" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Validasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <h5><i class="icon fas fa-info"></i> Validasi</h5>
                            Silahkan upload Edoc Produk Penetapan Hukum untuk melakukan Validasi.
                        </div>
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-verif-sita" method="post">
                            <input type="text" hidden name="id_verif_sita" id="id_verif_sita" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile"></label>
                                <input type="file" class="form-control" id="verif_sita" name="verif_sita" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
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