<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <?php if ($this->session->userdata('akses') == 4) { ?>
                    <div class="btn-group">
                        <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-penahanan">+ TAMBAH</button>
                    </div>
                <?php } ?>
                
            </div>
            <div class="col-5">
                <h3 class="m-0text-center"><?php echo $judul ?></h3>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    FILTER DATA
                </div>
            </div>
            <div class="col-sm-2">
                <!-- select -->
                <div class="form-group">
                    <select id="filter-table-ph" class="form-control">
                        <option value="">Semua</option>
                        <option value="terdaftar">Terdaftar</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>

                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="tabel-penahanan" class="table table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="2%" class="text-center">NO</th>
                        <th class="text-center" width="18%">NO SURAT PERMOHONAN</th>
                        <th width="12%" class="text-center">UNIT</th>
                        <th class="text-center" width="20%">EDOC RIWAYAT PENAHANAN</th>
                        <th class="text-center" width="23%">DOKUMEN PENDUKUNG</th>
                        <th class="text-center">PERPANJANGAN PENAHANAN</th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
</div>




<!-- MODAL TAMBAH IJIN SITA -->
<div id="modal-tambah-penahanan" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Surat Permohonan Perpanjangan Penahana </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-penahanan" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_smohon_ph" id="no_smohon_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_ph" id="unit_ph" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_ph" id="unit_ph" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Tahanan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <select name="jns_ph" id="jns_ph" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Rutan">Rutan</option>
                                                <option Value="Rumah">Rumah</option>
                                                <option Value="Kota">Kota</option>
                                            </select>
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
                                        <label>Nama<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nm_ph" id="nm_ph" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="nik_ph" id="nik_ph" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="t_lahir_ph" id="t_lahir_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="jk_ph" id="jk_ph" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="alamat_ph" id="alamat_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="agama_ph" id="agama_ph" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="pekerjaan_ph" id="pekerjaan_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="kebangsaan_ph" id="kebangsaan_ph" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih--</option>
                                                <option Value="WNI">WNI</option>
                                                <option Value="WNA">WNA</option>
                                            </select>
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan Perpanjangan Penahanan </label>

                                <input type="file" class="form-control" id="edoc_p1" name="edoc_p1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>

                                <input type="file" class="form-control" id="edoc_p2" name="edoc_p2" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>

                                <input type="file" class="form-control" id="edoc_p3" name="edoc_p3" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc SPDP</label>
                                <input type="file" class="form-control" id="edoc_p4" name="edoc_p4" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Resume</label>
                                <input type="file" class="form-control" id="edoc_p5" name="edoc_p5" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 5 Mb</span>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h4 class="text-danger text-bold">Disclaimer</h4>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disclaimerPh">
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

<!-- MODAL EDIT PENAHANAN -->
<div id="modal-edit-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Surat Permohonan Perpanjangan Penahanan</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edit-ph" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>
                                        <input type="text" hidden name="id_ph" id="id_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_smohon_ph_edit" id="no_smohon_ph_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_ph_edit" id="unit_ph_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_ph_edit" id="unit_ph_edit" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jenis Tahanan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <select name="jns_ph_edit" id="jns_ph_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                <option value="">-- Pilih --</option>
                                                <option Value="Rutan">Rutan</option>
                                                <option Value="Rumah">Rumah</option>
                                                <option Value="Kota">Kota</option>
                                            </select>
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
                                        <label>Nama<span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-6">
                                        <div class="controls">
                                            <input type="text" name="nm_ph_edit" id="nm_ph_edit" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="nik_ph_edit" id="nik_ph_edit" class="form-control" maxlength="16" minlength="1" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="t_lahir_ph_edit" id="t_lahir_ph_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="jk_ph_edit" id="jk_ph_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="alamat_ph_edit" id="alamat_ph_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="agama_ph_edit" id="agama_ph_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                            <input type="text" name="pekerjaan_ph_edit" id="pekerjaan_ph_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                            <select name="kebangsaan_ph_edit" id="kebangsaan_ph_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-detail-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Data Perpanjangan Penahanan</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">Data Perpanjangan Penahanan</th>


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
                                    <td>Jenis Penahanan</td>
                                    <td>
                                        <div id="d7"></div>
                                    </td>

                                </tr>
                                <!-- ---------------- -->
                                <tr>
                                    <th colspan="2">Identitas Tersangka</th>

                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>
                                        <div id="d8a"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>
                                        <div id="d8"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>
                                        <div id="d9"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>
                                        <div id="d10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>
                                        <div id="d11"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>
                                        <div id="d12"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>
                                        <div id="d13"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>
                                        <div id="d14"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Kebangsaan</td>
                                    <td>
                                        <div id="d15"></div>
                                    </td>
                                </tr>
                                <!-- ---------------- -->
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
                                    <td>E-Doc Surat SPDP</td>
                                    <td>
                                        <div id="d6"></div>
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
<div id="modal-edoc1-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Surat Permohonan</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc1-ph" method="post">

                            <input type="text" hidden name="id_edoc1" id="id_edoc1" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc1_ph_edit" name="edoc1_ph_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<div id="modal-edoc2-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc LP/LI/LM</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc2-ph" method="post">

                            <input type="text" hidden name="id_edoc2" id="id_edoc2" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc LP/LI/LM</label>
                                <input type="file" class="form-control" id="edoc2_ph_edit" name="edoc2_ph_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<div id="modal-edoc3-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Penetapan Tersangka</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc3-ph" method="post">

                            <input type="text" hidden name="id_edoc3" id="id_edoc3" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Penetapan Tersangka</label>
                                <input type="file" class="form-control" id="edoc3_ph_edit" name="edoc3_ph_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<div id="modal-edoc4-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Surat SPDP</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc4-ph" method="post">

                            <input type="text" hidden name="id_edoc4" id="id_edoc4" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat SPDP</label>
                                <input type="file" class="form-control" id="edoc4_ph_edit" name="edoc4_ph_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<div id="modal-riwayat" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">E-Doc Riwayat Penahanan</span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc-r" method="post">

                            <input type="text" hidden name="id_r" id="id_r" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Penahanan Penyidik</label>
                                <input type="file" class="form-control" id="edoc_r1" name="edoc_r1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Perpanjangan Penuntut Umum</label>
                                <input type="file" class="form-control" id="edoc_r2" name="edoc_r2" required="" data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-verif-ph" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
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
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-verif-ph" method="post">
                            <input type="text" hidden name="id_verif_ph" id="id_verif_ph" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <div class="form-group">
                                <label for="customFile"></label>
                                <input type="file" class="form-control" id="verif_ph" name="verif_ph" required="" data-validation-required-message="Tidak Boleh Kosong">
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