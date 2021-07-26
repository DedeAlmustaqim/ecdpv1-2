$(document).ready(function() {
    $("#modal-tambah-gd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-verif-gd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edit-gd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-smohon-gd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-lappolintel-gd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    var table = $('#tabel-gd').DataTable({
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [1, 'asc']
        ],

        "language": {
            "lengthMenu": "Tampilkan _MENU_ item per halaman",
            "zeroRecords": "Tidak ada data yang ditampilkan",
            "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data yang ditampilkan",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Cari",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
        },
        "displayLength": 25,
        "ajax": {
            "url": BASE_URL + "/penyelidikan/json_penyelidikan",
            "dataSrc": "data",
            "dataType": "json",

        },
        "columns": [{
                "data": "urut_gd",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_gd +
                            '<br><span class="badge badge-warning">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_gd +
                            '<br><span class="badge badge-info">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by + '</small></div>'

                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_gd +
                            '<br><span class="badge badge-success ">Selesai</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by + '</small></div>'

                    }

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.nm_unit + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 0) {

                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +

                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 0) {

                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-reupload-smohon-gd" data-id="' + data.id_smohon_gd + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-reupload-lappolintel-gd" data-id="' + data.id_smohon_gd + '" > [Reupload]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-sprint" href="#"  data-toggle="modal" data-target="#modal-reupload-sprint" data-id="' + data.id_smohon_gd + '" > [Reupload]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-spg" href="#"  data-toggle="modal" data-target="#modal-reupload-spg" data-id="' + data.id_smohon_gd + '" > [Reupload]</a>' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +

                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Perintah Geledah' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/gd/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    }


                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center"><div class="margin">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaValid(this)" data-srt="' + data.no_smohon_gd + '" data-id="' + data.id_smohon_gd + '" data-edoc="' + data.verif_doc + '">Batalkan Validasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center"><div class="margin">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerif(this)" data-srt="' + data.no_smohon_gd + '" data-id="' + data.id_smohon_gd + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-gd"  data-id="' + data.id_smohon_gd + '" >Validasi</button>' +
                                '</div>&nbsp;' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center"><div class="margin">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" onClick="VerifGd(this)"  data-id="' + data.id_smohon_gd + '"  data-srt="' + data.no_smohon_gd + '" >Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-gd" data-id="' + data.id_smohon_gd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-gd" data-id="' + data.id_smohon_gd + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm detail" onClick="HapusPyd(this)" data-srt="' + data.no_smohon_gd + '"  data-id="' + data.id_smohon_gd + '" data-smohon="' + data.edoc_s_mohon + '" data-lap="' + data.edoc_lap_pol_intel + '" data-valid="' + data.validasi + '">Hapus</button>' +
                                '</div>' +
                                '</div>'
                        }
                    }

                }


            },
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    /* Formatting function for row details - modify as you need */

    function format(data) {
        // `d` is the original data object for the row
        if (data.updated_at_gd == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_gd + ' Oleh : ' + data.create_by_gd + '</small></td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_gd + ' Oleh : ' + data.create_by_gd + ' | Diedit pada : ' + data.updated_at_gd + ' Oleh : ' + data.update_by_gd + '</small></td>' +
                '</tr>' +
                '</table> ';
        }
    }

    $('#tabel-gd tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
    $('#filter-table-gd').on('change', function() {
        table.search(this.value).draw();
    });
});

$('#form-tambah-smohongd').on('submit', function(e) {
    checked = $("input[type=checkbox]:checked").length;

    if (!checked) {
        swal({
            type: 'warning',
            title: '',
            text: 'Mohon untuk menyetujui Disclaimer',
            timer: 2000,
        });
        return false;
    }
    e.preventDefault();
    var postData = new FormData($("#form-tambah-smohongd")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyelidikan/tambah_pyd",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        beforeSend: function() {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function(data) {
            if (data.error) {
                swal({
                    type: 'warning',
                    title: 'Gagal Simpan Data',
                    text: 'Format atau Ukuran File tidak Sesuai',
                    timer: 2000,
                })
            }
            if (data.success) {
                swal({
                    type: 'success',
                    title: 'Simpan Data',
                    text: 'Berhasil Simpan data',
                    timer: 2000,
                })
                $('#no_srt_gd').val('');
                $('#unit_gd').val('');
                $('#jns_gd').val('');
                $('#lok_gd').val('');
                $('#pemilik_lok_gd').val('');
                $('#edoc_s_mohon').val('');
                $('#edoc_lap_pol_intel').val('');
                $('#modal-tambah-gd').modal('hide');
                $('#disclaimerGd').prop('checked', false); // Unchecks it
                $('#tabel-gd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-gd').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyelidikan/get_id_penyelidikan/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_gd;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = data.jns_gd;
            document.getElementById('d4').innerHTML = data.lok_gd;
            document.getElementById('d5').innerHTML = data.pemilik_lok_gd;
            document.getElementById('d6').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/gd/' + data.edoc_s_mohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d7').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/gd/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d8').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/gd/' + data.edoc_sprint + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d9').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/gd/' + data.edoc_spg + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });
});

$('#form-edit-smohongd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-smohongd")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyelidikan/edit_pyd",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        beforeSend: function() {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function(data) {
            swal({
                type: 'success',
                title: 'Update',
                text: 'Berhasil Simpan Data',
                timer: 2000,
            })
            $('#modal-edit-gd').modal('hide');
            $('#tabel-gd').DataTable().ajax.reload(null, false);
        },
        error: function(data) {
            swal({
                type: 'warning',
                title: 'Gagal',
                timer: 2000,
            })
            $('#modal-edit-gd').modal('hide');
            $('#tabel-gd').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

$('#tabel-gd').on('click', '.verif', function() {
    var id = $(this).data('id');

    $('#id_verif_gd').val(id);
});

$('#form-verif-gd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-gd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyelidikan/valid",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function() {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function(data) {
            if (data.error) {
                swal({
                    type: 'warning',
                    title: 'Gagal Simpan Data',
                    text: 'Format atau Ukuran File tidak Sesuai',
                    timer: 2000,
                })
            }
            if (data.success) {
                swal({
                    type: 'success',
                    title: 'Simpan Data',
                    text: 'Berhasil Simpan data',
                    timer: 2000,
                })

                $('#modal-verif-gd').modal('hide');
                // TUTUP MODAL
                $('#tabel-gd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-gd').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyelidikan/get_id_penyelidikan/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            $('#valid_gd').val(data['validasi']);
            $('#id_gd_edit').val(data['id_smohon_gd']);
            $('#no_srt_gd_edit').val(data['no_smohon_gd']);
            $('#unit_gd_edit').val(data['id_unit']);
            $('#jns_gd_edit').val(data['jns_gd']);
            $('#lok_gd_edit').val(data['lok_gd']);
            $('#pemilik_lok_gd_edit').val(data['pemilik_lok_gd']);
            $('#pemilik_lok_gd_edit').val(data['pemilik_lok_gd']);

        }
    });

});

//REUPLOAD SMOHON
$('#tabel-gd').on('click', '.reupload-s-mohon', function() {
    var id = $(this).data('id');
    $('#id_smohon_edoc1').val(id);

});
//REUPLOAD LAPPOLINTEL
$('#tabel-gd').on('click', '.reupload-lap-pol-intel', function() {
    var id = $(this).data('id');
    $('#id_lap_pol_intel_edoc1').val(id);

});

$('#form-reupload-smohon').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-reupload-smohon")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyelidikan/reupload_smohon",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        success: function(data) {
            if (data.error) {
                swal({
                    type: 'warning',
                    title: 'Gagal Simpan Data',
                    text: 'Format atau Ukuran File tidak Sesuai',
                    timer: 2000,
                })
            }
            if (data.success) {
                swal({
                    type: 'success',
                    title: 'Simpan Data',
                    text: 'Berhasil Simpan data',
                    timer: 2000,
                })
                $('#id_smohon_edoc1').val('');
                $('#edoc_s_mohon_edit').val('');
                $('#modal-reupload-smohon-gd').modal('hide');
                // TUTUP MODAL
                $('#tabel-gd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#form-reupload-lap-pol-intel').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-reupload-lap-pol-intel")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyelidikan/reupload_lap_pol_intel",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function() {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function(data) {
            if (data.error) {
                swal({
                    type: 'warning',
                    title: 'Gagal Simpan Data',
                    text: 'Format atau Ukuran File tidak Sesuai',
                    timer: 2000,
                })
            }
            if (data.success) {
                swal({
                    type: 'success',
                    title: 'Simpan Data',
                    text: 'Berhasil Simpan data',
                    timer: 2000,
                })
                $('#id_lap_pol_intel_edoc1').val('');
                $('#edoc_lap_pol_intel_edit').val('');
                $('#modal-reupload-lappolintel-gd').modal('hide');
                // TUTUP MODAL
                $('#tabel-gd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function VerifGd(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    swal({
        title: 'Verifikasi',
        text: srt,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function(isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'penyelidikan/verif/',
            type: "POST",
            data: {

                id: id,

            },
            success: function() {
                swal({
                    type: 'success',
                    title: srt,
                    text: 'Diverifikasi',
                    timer: 2000,
                })
                $('#tabel-gd').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}

function BukaVerif(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");

        swal({
            title: 'Batalkan Verifikasi',
            text: 'Yakin untuk Batalkan Verifikasi ' + srt + ' ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'YA',

            closeOnConfirm: false,
        }, function(isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: BASE_URL + 'penyelidikan/buka_verif/',
                type: "POST",
                data: {

                    id: id,

                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Verifikasi',
                        timer: 2000,
                    })
                    $('#tabel-gd').DataTable().ajax.reload(null, false);

                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    } else {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Hubungi Admin',
            timer: 3000,
        })
    }
}

function BukaValid(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");
        var edoc = $(elem).data("edoc");
        swal({
            title: 'Batalkan Validasi',
            text: 'Yakin untuk Batalkan Validasi ' + srt + ' ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'YA',

            closeOnConfirm: false,
        }, function(isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: BASE_URL + 'penyelidikan/buka_valid/',
                type: "POST",
                data: {

                    id: id,
                    edoc: edoc
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Verifikasi',
                        timer: 2000,
                    })
                    $('#tabel-gd').DataTable().ajax.reload(null, false);

                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    } else {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Hubungi Admin',
            timer: 3000,
        })
    }
}


function HapusPyd(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");

    swal({
        title: 'Hapus',
        text: 'Anda Yakin Hapus Data Penyelidikan ' + srt + '?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function(isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'Penyelidikan/delete_pyd/',
            type: "POST",
            data: {

                id: id,
                smohon: smohon,
                lap: lap
            },
            success: function() {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-gd').DataTable().ajax.reload(null, false);
            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}