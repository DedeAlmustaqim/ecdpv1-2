<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="btn-group">
                    <?php if ($this->session->userdata('akses') == 4) { ?>
                        <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-py">+ TAMBAH</button>
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
                    <select id="filter-table-py" class="form-control">
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
            <table id="tabel-py" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="2%" class="text-center">NO</th>
                        <th class="text-center" width="20%">NO SURAT PERMOHONAN</th>
                        <th class="text-center" width="15%">UNIT</th>
                        <th class="text-center" width="30%">DOKUMEN PENDUKUNG</th>
                        <th class="text-center">TAHAP PENYIDIKAN</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>





<!-- MODAL TAMBAH PENYIDIKAN DATA -->
<div id="modal-tambah-py" class="modal fade bs-example-modal-lg" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Surat Permohonan Penyidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-py" method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_srt_py" id="no_srt_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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

                                                <select name="unit_py" id="unit_py" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                            <?php } else { ?>
                                <input type="text" hidden name="unit_py" id="unit_py" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                            <?php } ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <div class="controls">
                                            <select name="jns_py" id="jns_py" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="lok_py" id="lok_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="pemilik_lok_py" id="pemilik_lok_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>IDENTITAS TERSANGKA </h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nm_py" id="nm_py" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>NIK <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nik_py" id="nik_py" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="t_lahir_py" id="t_lahir_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-2">
                                        <select name="tgl" id="tgl" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Tanggal</option>
                                            <?php
                                            for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                echo " <option value='$tgl'>$tgl</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                    <div class="col-2">
                                        <select name="bln" id="bln" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Bulan</option>
                                            <?php
                                            for ($bln = 1; $bln <= 12; $bln++) {
                                                echo " <option value='$bln'>$bln</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                    <div class="col-2">
                                        <select name="ta" id="ta" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Tahun</option>
                                            <?php
                                            for ($ta = 1950; $ta <= 2015; $ta++) {
                                                echo " <option value='$ta'>$ta</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <select name="jk_py" id="jk_py" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Pria">Pria</option>
                                                <option Value="Wanita">Wanita</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Alamat <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="alamat_py" id="alamat_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Agama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <div class="controls">
                                            <select name="agama_py" id="agama_py" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Islam">Islam</option>
                                                <option Value="Kristen">Kristen</option>
                                                <option Value="Katholik">Katholik</option>
                                                <option Value="Hindu">Hindu</option>
                                                <option Value="Budha">Budha</option>
                                                <option Value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pekerjaan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="pekerjaan_py" id="pekerjaan_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kebangsaan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-3">
                                        <div class="controls">
                                            <select name="kebangsaan_py" id="kebangsaan_py" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih--</option>
                                                <option Value="WNI">WNI</option>
                                                <option Value="WNA">WNA</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>E-DOC</h4>
                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id="edoc_s_mohon_py" name="edoc_s_mohon_py" required="" data-validation-required-message="Tidak Boleh Kosong">
                                    <div class="help-block text-danger"></div>
                                    <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <label for="customFile">E-Doc Surat LP/LI/LM</label>
                                    <input type="file" class="form-control" id="edoc_lap_pol_intel_py" name="edoc_lap_pol_intel_py" required="" data-validation-required-message="Tidak Boleh Kosong">
                                </div>
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>
                                <input type="file" class="form-control" id="edoc_pen_tersangka_py" name="edoc_pen_tersangka_py" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc SPDP</label>
                                <input type="file" class="form-control" id="edoc_spdp" name="edoc_spdp" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h4 class="text-danger text-bold">Disclaimer</h4>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disclaimerPy">
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
<!-- MODAL EDIT PENYELIDIKAN DATA -->
<div id="modal-edit-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Surat Permohonan Penyidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" id="form-edit-py" method="post">
                            <input hidden type="text" name="id_py" id="id_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                            <input hidden type="text" name="validasi_py" id="validasi_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_srt_py_edit" id="no_srt_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <?php if ($this->session->userdata('akses') != 4) { ?>
                                                <label>Unit <span class="text-danger">*</span></label>

                                                <select name="unit_py_edit" id="unit_py_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                    <option value="">-- Pilih --</option>
                                                    <?php foreach ($unit as $u) { ?>
                                                        <option value="<?php echo $u->id_unit ?>"><?php echo $u->nm_unit ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block text-danger"></div>
                                            <?php } else { ?>
                                                <input type="text" hidden name="unit_py_edit" id="unit_py_edit" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Geledah <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <div class="controls">
                                            <select name="jns_py_edit" id="jns_py_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="lok_py_edit" id="lok_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="pemilik_lok_py_edit" id="pemilik_lok_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>IDENTITAS TERSANGKA </h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Nama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nm_py_edit" id="nm_py_edit" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>NIK <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nik_py_edit" id="nik_py_edit" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tempat Lahir <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="t_lahir_py_edit" id="t_lahir_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-2">
                                        <select name="tgl_edit" id="tgl_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Tanggal</option>
                                            <?php
                                            for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                echo " <option value='$tgl'>$tgl</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                    <div class="col-2">
                                        <select name="bln_edit" id="bln_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Bulan</option>
                                            <?php
                                            for ($bln = 1; $bln <= 12; $bln++) {
                                                echo " <option value='$bln'>$bln</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                    <div class="col-2">
                                        <select name="ta_edit" id="ta_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                            <option value="">Tahun</option>
                                            <?php
                                            for ($ta = 1950; $ta <= 2015; $ta++) {
                                                echo " <option value='$ta'>$ta</option>";
                                            }
                                            ?>
                                        </select>
                                        <div class="help-block text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <select name="jk_py_edit" id="jk_py_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Pria">Pria</option>
                                                <option Value="Wanita">Wanita</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Alamat <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="controls">
                                            <input type="text" name="alamat_py_edit" id="alamat_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Agama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-4">
                                        <div class="controls">
                                            <select name="agama_py_edit" id="agama_py_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Islam">Islam</option>
                                                <option Value="Kristen">Kristen</option>
                                                <option Value="Katholik">Katholik</option>
                                                <option Value="Hindu">Hindu</option>
                                                <option Value="Budha">Budha</option>
                                                <option Value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Pekerjaan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="pekerjaan_py_edit" id="pekerjaan_py_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Kebangsaan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-3">
                                        <div class="controls">
                                            <select name="kebangsaan_py_edit" id="kebangsaan_py_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih--</option>
                                                <option Value="WNI">WNI</option>
                                                <option Value="WNA">WNA</option>
                                            </select>
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
<div id="modal-detail-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Data Penyidikan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

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
                                    <th colspan="2">Identitas Tersangka</th>
                                </tr>
                                <tr>
                                    <td>NAMA</td>
                                    <td>
                                        <div id="d6a"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>
                                        <div id="d6"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>
                                        <div id="d7"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                        <div id="d8"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>
                                        <div id="d9"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <div id="d10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>
                                        <div id="d11"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>
                                        <div id="d12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kebangsaan</td>
                                    <td>
                                        <div id="d13"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2">E-DOC</th>
                                </tr>
                                <tr>
                                    <td>E-Doc Surat Permohonan</td>
                                    <td>
                                        <div id="d14"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc LP/LI/LM</td>
                                    <td>
                                        <div id="d15"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Penetapan Tersangka</td>
                                    <td>
                                        <div id="d16"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc SPDP</td>
                                    <td>
                                        <div id="d17"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
<div id="modal-reupload-smohon-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Surat Permohonan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc1-py" method="post">
                            <input type="text" hidden name="id_edoc1" id="id_edoc1" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc1_py" name="edoc1_py" required="" data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-reupload-lappolintel-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc LP/LI/LM</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc2-py" method="post">
                            <input type="text" hidden name="id_edoc2" id="id_edoc2" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc2_py" name="edoc2_py" required="" data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-reupload-penetapan-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Penetapan Tersangka</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc3-py" method="post">
                            <input type="text" hidden name="id_edoc3" id="id_edoc3" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>
                                <input type="file" class="form-control" id="edoc3_py" name="edoc3_py" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">Simpan</button>
                                <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            </div>
                            b
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-reupload-spdp-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc SPDP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h5 class="text-right">Reupload E-Doc SPDP</h5>
                    </div>
                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc4-py" method="post">
                            <input type="text" hidden name="id_edoc4" id="id_edoc4" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile">E-Doc SPDP</label>
                                <input type="file" class="form-control" id="edoc4_py" name="edoc4_py" required="" data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-verif-py" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header">
                <h5 class="text-right">Verifikasi</h5>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Verifikasi</h5>
                            Silahkan upload Edoc Produk Penetapan Hukum untuk melakukan Verifikasi.
                        </div>
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-verif-py" method="post">
                            <input type="text" hidden name="id_verif_py" id="id_verif_py" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile"></label>
                                <input type="file" class="form-control" id="verif_py" name="verif_py" required="" data-validation-required-message="Tidak Boleh Kosong">
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