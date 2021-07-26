<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="m-b-0 text-white"><?php echo $judul ?></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
            <?php if ($this->session->userdata('akses') != 4) { ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-block btn-outline-info" data-toggle="modal" data-target="#modal-tambah-pd">+ TAMBAH</button>
                </div>
                <?php } ?>
                
            </div>
            <div class="col-6">
                <h3 class="m-0 text-center"><?php echo $judul ?></h3>
            </div>
            <div class="col-sm-1">
                <div class="form-group">
                    FILTER DATA
                </div>
            </div>
            <div class="col-sm-2">
                <!-- select -->
                <div class="form-group">
                    <select id="filter-table-pd" class="form-control">
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
            <table id="tabel-pd" class="table table-bordered" width="100%">
                <thead>
                    <tr">
                        <th width="2%" class="text-center">NO</th>
                        <th class="text-center" width="30%">NO SURAT PERMOHONAN</th>
                        <th class="text-center" width="15%">UNIT</th>
                        <th class="text-center" width="25%">DOKUMEN PENDUKUNG</th>
                        <th class="text-center">PENYADAPAN</th>
                        </tr>
                </thead>
            </table>
        </div>
    </div>
</div>



<!-- MODAL TAMBAH PENYELIDIKAN DATA -->
<div id="modal-tambah-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tambah Surat Permohonan Penyadapan </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-tambah-pd" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" name="no_srt_pd" id="no_srt_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_pd" id="unit_pd" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_pd" id="unit_pd" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Device yang digunakan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="perangkat_pd" id="perangkat_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jangka Waktu <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Mulai</label>
                                                </div>
                                                <div class="col-3">
                                                    <select name="tgl1" id="tgl1" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tanggal</option>
                                                        <?php
                                                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                            echo " <option value='$tgl'>$tgl</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="bln1" id="bln1" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Bulan</option>
                                                        <?php
                                                        for ($bln = 1; $bln <= 12; $bln++) {
                                                            echo " <option value='$bln'>$bln</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="ta1" id="ta1" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tahun</option>
                                                        <?php
                                                        for ($ta = 2018; $ta <= 2021; $ta++) {
                                                            echo " <option value='$ta'>$ta</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Berakhir</label>
                                                </div>
                                                <div class="col-3">
                                                    <select name="tgl2" id="tgl2" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tanggal</option>
                                                        <?php
                                                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                            echo " <option value='$tgl'>$tgl</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="bln2" id="bln2" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Bulan</option>
                                                        <?php
                                                        for ($bln = 1; $bln <= 12; $bln++) {
                                                            echo " <option value='$bln'>$bln</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="ta2" id="ta2" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tahun</option>
                                                        <?php
                                                        for ($ta = 2018; $ta <= 2021; $ta++) {
                                                            echo " <option value='$ta'>$ta</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Lokasi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="lokasi_pd" id="lokasi_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc1" name="edoc1" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Laporan Polisi/Intelejen</label>
                                <input type="file" class="form-control" id="edoc2" name="edoc2" required="" data-validation-required-message="Tidak Boleh Kosong">
                                <div class="help-block text-danger"></div>
                                <span class="badge badge-warning">Jenis File hanya .*Pdf ; Ukuran Maksimal 3 Mb</span>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group text-center">
                                        <h4 class="text-danger text-bold">Disclaimer</h4>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="disclaimerPd">
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

<div id="modal-edit-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Edit Surat Permohonan Penyadapan </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edit-pd" method="post">

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>No Surat Permohonan <span class="text-danger">*</span></label>

                                    </div>
                                    <div class="col-5">
                                        <div class="controls">
                                            <input type="text" hidden name="id_smohon_pd" id="id_smohon_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <input type="text" name="no_srt_pd_edit" id="no_srt_pd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
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
                                                <select name="unit_pd_edit" id="unit_pd_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
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
                                <input type="text" hidden name="unit_pd_edit" id="unit_pd_edit" value="<?php echo $this->session->userdata('ses_id_unit') ?>" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">

                            <?php } ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Device yang digunakan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="perangkat_pd_edit" id="perangkat_pd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Jangka Waktu <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Mulai</label>
                                                </div>
                                                <div class="col-3">
                                                    <select name="tgl1_edit" id="tgl1_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tanggal</option>
                                                        <?php
                                                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                            echo " <option value='$tgl'>$tgl</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="bln1_edit" id="bln1_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Bulan</option>
                                                        <?php
                                                        for ($bln = 1; $bln <= 12; $bln++) {
                                                            echo " <option value='$bln'>$bln</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="ta1_edit" id="ta1_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tahun</option>
                                                        <?php
                                                        for ($ta = 2018; $ta <= 2021; $ta++) {
                                                            echo " <option value='$ta'>$ta</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label>Berakhir</label>
                                                </div>
                                                <div class="col-3">
                                                    <select name="tgl2_edit" id="tgl2_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tanggal</option>
                                                        <?php
                                                        for ($tgl = 1; $tgl <= 31; $tgl++) {
                                                            echo " <option value='$tgl'>$tgl</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="bln2_edit" id="bln2_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Bulan</option>
                                                        <?php
                                                        for ($bln = 1; $bln <= 12; $bln++) {
                                                            echo " <option value='$bln'>$bln</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                                <div class="col-3">
                                                    <select name="ta2_edit" id="ta2_edit" class="form-control" required data-validation-required-message="Tidak Boleh Kosong">
                                                        <option value="">Tahun</option>
                                                        <?php
                                                        for ($ta = 2018; $ta <= 2021; $ta++) {
                                                            echo " <option value='$ta'>$ta</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <div class="help-block text-danger"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label>Lokasi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-7">
                                        <div class="controls">
                                            <input type="text" name="lokasi_pd_edit" id="lokasi_pd_edit" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                                            <div class="help-block text-danger"></div>
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

<!-- MODAL DETAIL DATA PENYELIDIKAN -->
<div id="modal-detail-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Detail Data Penyadapan </span></h4>
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
                                    <td>Perangkat</td>
                                    <td>
                                        <div id="d3"></div>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Jangka Waktu</td>
                                    <td>
                                        Mulai : <span id="d4"></span> Berakhir : <span id="d5"></span>

                                    </td>

                                </tr>
                                <tr>
                                    <td> Lokasi</td>
                                    <td>
                                        <div id="d6"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Surat Permohonan</td>
                                    <td>
                                        <div id="d7"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Doc Laporan Polisi/Inteligen</td>
                                    <td>
                                        <div id="d8"></div>
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
<div id="modal-edoc1-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Surat Permohonan </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc1-pd" method="post">

                            <input type="text" hidden name="id_pd" id="id_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Surat Permohonan</label>
                                <input type="file" class="form-control" id="edoc1_pd_edit" name="edoc1_pd_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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
<div id="modal-edoc2-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Reupload E-Doc Laporan Polisi/Intilegen </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">

                    <div class="card-body">
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-edoc2-pd" method="post">
                            <input type="text" hidden name="id_pd2" id="id_pd2" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">


                            <div class="form-group">
                                <label for="customFile">E-Doc Laporan Polisi Intiligen</label>
                                <input type="file" class="form-control" id="edoc2_pd_edit" name="edoc2_pd_edit" required="" data-validation-required-message="Tidak Boleh Kosong">
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

<div id="modal-verif-pd" class="modal fade bs-example-modal-lg" tab-index="-1" role="documnet" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Validasi </span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-secondary">
                    <div class="card-body">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-info"></i> Validasi</h5>
                            Silahkan upload Edoc Produk Penetapan Hukum untuk melakukan Verifikasi.
                        </div>
                        <form class="m-t-0" novalidate="" enctype="multipart/form-data" id="form-verif-pd" method="post">
                            <input type="text" hidden name="id_verif_pd" id="id_verif_pd" class="form-control" required="" data-validation-required-message="Tidak Boleh Kosong">
                            <div class="form-group">
                                <label for="customFile"></label>
                                <input type="file" class="form-control" id="verif_pd" name="verif_pd" required="" data-validation-required-message="Tidak Boleh Kosong">
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