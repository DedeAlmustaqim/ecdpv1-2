<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="btn-group">
                    <?php if ($this->session->userdata('akses') == 4) { ?>
                        <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-gd">+ TAMBAH</button>
                    <?php } ?>
                </div>
            </div>
            <div class="col-6">
                <h3 class="text-center"><?php echo $judul ?></h3>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    FILTER DATA
                </div>
            </div>
            <div class="col-sm-2">
                <!-- select -->
                <div class="form-group">
                    <select id="filter-table-gd" class="form-control">
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
            <table id="tabel-gd" class="table table-bordered" width="100%">
                <thead>
                    <tr">
                        <th width="2%" class="text-center">NO</th>
                        <th class="text-center" width="20%">NO SURAT PERMOHONAN</th>
                        <th class="text-center" width="15%">UNIT</th>
                        <th class="text-center" width="30%">DOKUMEN PENDUKUNG</th>
                        <th class="text-center">TAHAP PENYELIDIKAN</th>
                        </tr>
                </thead>
            </table>
        </div>
    </div>
</div>




<!-- MODAL TAMBAH PENYELIDIKAN DATA -->
<div id="modal-tambah-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Surat Penyelidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-smohongd" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" placeholder="No Surat" name="no_srt_gd" id="no_srt_gd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_gd" id="unit_gd" class="custom-select mr-sm-2" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_gd" id="unit_gd" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <select name="jns_gd" id="jns_gd" class="custom-select mr-sm-2" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Badan">Badan</option>
                                                <option Value="Bangunan">Bangunan</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Lokasi Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" placeholder="Lokasi Geledah" name="lok_gd" id="lok_gd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pemilik Lokasi Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" placeholder="Pemilik Lokasi Geledah " name="pemilik_lok_gd" id="pemilik_lok_gd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc_s_mohon" name="edoc_s_mohon" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>

                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Surat LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc_lap_pol_intel" name="edoc_lap_pol_intel" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc SPRINT</label>
                                <input type="file" class="form-control" id="edoc_sprint" name="edoc_sprint" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>

                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Perintah Geledah</label>
                                <input type="file" class="form-control" id="edoc_spg" name="edoc_spg" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h4 class="text-danger text-bold">Disclaimer</h4>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disclaimerGd">
                                            <label class="form-check-label">Saya menyatakan bahwa data yang saya Entry bersifat benar dan dapat dipertanggungjawabkan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit gd-simpan" class="btn btn-info">Simpan</button>
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

<!-- MODAL EDIT PENYELIDIKAN DATA -->
<div id="modal-edit-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Surat Penyelidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edit-smohongd" method="post">
                            <input hidden type="text" name="id_gd_edit" id="id_gd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                            <input hidden type="text" name="valid_gd" id="valid_gd" value="" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_srt_gd_edit" id="no_srt_gd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_gd_edit" id="unit_gd_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_gd_edit" id="unit_gd_edit" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Geledah <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <select name="jns_gd_edit" id="jns_gd_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Badan">Badan</option>
                                                <option Value="Bangunan">Bangunan</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Lokasi Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="lok_gd_edit" id="lok_gd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pemilik Lokasi Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="pemilik_lok_gd_edit" id="pemilik_lok_gd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
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
    </div>
</div>

<!-- MODAL DETAIL DATA PENYELIDIKAN -->
<div id="modal-detail-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Data Penyelidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Data Penyelidikan</th>


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
                                    <td>Jenis Geledah</td>
                                    <td>
                                        <div id="d3"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Lokasi Geledah</td>
                                    <td>
                                        <div id="d4"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Pemilik Lokasi Geledah</td>
                                    <td>
                                        <div id="d5"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Surat Permohonan</td>
                                    <td>
                                        <div id="d6"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc LP/LI/LM</td>
                                    <td>
                                        <div id="d7"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc SPRINT</td>
                                    <td>
                                        <div id="d8"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Surat Perintah Geledah</td>
                                    <td>
                                        <div id="d9"></div>
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
<div id="modal-reupload-smohon-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Surat Permohonan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-body">
                        <form novalidate="" enctype="multipart/form-data" id="form-reupload-smohon" method="post">

                            <input type="text" hidden name="id_smohon_edoc1" id="id_smohon_edoc1" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc_s_mohon_edit" name="edoc_s_mohon_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

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
    </div>
</div>

<!-- MODAL EDIT reupload laporan polisi/intel -->
<div id="modal-reupload-lappolintel-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc LP/LI/LM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-reupload-lap-pol-intel" method="post">
                            <input type="text" hidden name="id_lap_pol_intel_edoc1" id="id_lap_pol_intel_edoc1" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc_lap_pol_intel_edit" name="edoc_lap_pol_intel_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

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
    </div>
</div>

<!-- MODAL EDIT reupload laporan polisi/intel -->
<div id="modal-verif-gd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title" id="myLargeModalLabel">Validasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">

                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Validasi</h5>
                            Silahkan upload Edoc Produk Penetapan Hukum untuk melakukan Verifikasi.
                        </div>
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-verif-gd" method="post">
                            <input type="text" hidden name="id_verif_gd" id="id_verif_gd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile"></label>
                                <input type="file" class="form-control" id="verif_gd" name="verif_gd" required="" data-validation-required-message="Tidak Boleh Kosong">
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