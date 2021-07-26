$(document).ready(function() {
    $("#modal-tambah-pd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-edit-pd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc1-pd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc2-pd").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-verif-pd").on('hide.bs.modal', function(e) {
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
    var table = $('#tabel-pd').DataTable({
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
            "url": BASE_URL + "/penyadapan/json_pd",
            "dataSrc": "data",
            "dataType": "json",

        },
        "columns": [

            {
                "data": "urut_pd",
                "orderable": true,

            },

            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_pd +
                            '<br><span class="badge badge-warning ">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_pd +
                            '<br><span class="badge badge-info">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by + '</small></div>'

                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_pd +
                            '<br><span class="badge badge-success">Selesai</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
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
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-edoc1-pd" data-id="' + data.id_smohon_pd + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-edoc2-pd" data-id="' + data.id_smohon_pd + '" > [Reupload]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 0) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-edoc1-pd" data-id="' + data.id_smohon_pd + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-edoc2-pd" data-id="' + data.id_smohon_pd + '" > [Reupload]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">- Surat Permohonan' +
                                '<a href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</a>' +
                                '<br>- LP/LI/LM' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/pd/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
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
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaValidPd(this)" data-srt="' + data.no_smohon_pd + '" data-id="' + data.id_smohon_pd + '" edoc="' + data.verif_doc + '">Batalkan Validasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center"><div class="margin">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerifPd(this)" data-srt="' + data.no_smohon_pd + '" data-id="' + data.id_smohon_pd + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-pd"  data-id="' + data.id_smohon_pd + '" >Validasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center"><div class="margin">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                /*
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-pd" data-id="' + data.id_smohon_pd + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm detail" onClick="HapusPd(this)" data-srt="' + data.no_smohon_pd + '"  data-id="' + data.id_smohon_pd + '" data-smohon="' + data.edoc_s_mohon + '" data-lap="' + data.edoc_lap_pol_intel + '" data-valid="' + data.validasi + '">Hapus</button>' +
                                '</div>&nbsp;' +
                                */
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="VerifPd(this)" data-srt="' + data.no_smohon_pd + '" data-id="' + data.id_smohon_pd + '" >Verifikasi</button>' +
                                '</div>&nbsp' +
                                '</div>';
                        }
                    } else {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +

                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pd" data-id="' + data.id_smohon_pd + '">Detail</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-pd" data-id="' + data.id_smohon_pd + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" onClick="HapusPd(this)" data-srt="' + data.no_smohon_pd + '"  data-id="' + data.id_smohon_pd + '" data-smohon="' + data.edoc_s_mohon + '" data-lap="' + data.edoc_lap_pol_intel + '" data-valid="' + data.validasi + '">Hapus</button>' +
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
        if (data.updated_at_pd == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_pd + ' Oleh : ' + data.create_by_pd + '</small></td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_pd + ' Oleh : ' + data.create_by_pd + '| Diedit pada : ' + data.updated_at_pd + ' Oleh : ' + data.update_by_pd + '</small></td>' +
                '</tr>' +
                '</table> ';
        }

    }



    $('#tabel-pd tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
    $('#filter-table-pd').on('change', function() {
        table.search(this.value).draw();
    });
});

$('#form-tambah-pd').on('submit', function(e) {
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
    var postData = new FormData($("#form-tambah-pd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyadapan/tambah_pd",
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

                $('#modal-tambah-pd').modal('hide');
                $('#disclaimerPd').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-pd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

//AMBIL DATA EDIT PG
$('#tabel-pd').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyadapan/get_pd/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_pd;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = data.device;
            document.getElementById('d4').innerHTML = data.jk_start;
            document.getElementById('d5').innerHTML = data.jk_end;
            document.getElementById('d6').innerHTML = data.lokasi_pd;
            document.getElementById('d7').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/pd/' + data.edoc_s_mohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d8').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/pd/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });

});

$('#form-edit-pd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-pd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyadapan/edit_pd",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        success: function(data) {
            swal({
                    type: 'success',
                    title: 'Update',
                    text: 'Berhasil Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-pd').modal('hide');
            // TUTUP MODAL
            $('#tabel-pd').DataTable().ajax.reload(null, false);
        },
        error: function(data) {

            swal({
                    type: 'warning',
                    title: 'Update',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-gd').modal('hide');
            // TUTUP MODAL
            $('#tabel-gd').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

$('#tabel-pd').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyadapan/get_pd/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            $('#id_smohon_pd').val(id);
            $('#no_srt_pd_edit').val(data['no_smohon_pd']);
            $('#unit_pd_edit').val(data['id_unit']);
            $('#perangkat_pd_edit').val(data['device']);
            $('#tgl1_edit').val(data['tgl1']);
            $('#bln1_edit').val(data['bl1']);
            $('#ta1_edit').val(data['ta1']);
            $('#tgl2_edit').val(data['tgl2']);
            $('#bln2_edit').val(data['bl2']);
            $('#ta2_edit').val(data['ta2']);
            $('#lokasi_pd_edit').val(data['lokasi_pd']);
        }
    });

});

//REUPLOAD SMOHON
$('#tabel-pd').on('click', '.reupload-s-mohon', function() {
    var id = $(this).data('id');
    $('#id_pd').val(id);

});
//REUPLOAD LAPPOLINTEL
$('#tabel-pd').on('click', '.reupload-lap-pol-intel', function() {
    var id = $(this).data('id');
    $('#id_pd2').val(id);

});

$('#form-edoc1-pd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-pd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyadapan/reupload_smohon",
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

                $('#modal-edoc1-pd').modal('hide');
                // TUTUP MODAL
                $('#tabel-pd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#form-edoc2-pd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-pd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyadapan/reupload_lap_pol_intel",
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

                $('#modal-edoc2-pd').modal('hide');
                // TUTUP MODAL
                $('#tabel-pd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-pd').on('click', '.verif', function() {
    var id = $(this).data('id');

    $('#id_verif_pd').val(id);
});

$('#form-verif-pd').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-pd")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyadapan/valid",
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

                $('#modal-verif-pd').modal('hide');
                // TUTUP MODAL
                $('#tabel-pd').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function BukaVerifPd(elem) {
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
                url: BASE_URL + 'penyadapan/buka_verif/',
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
                    $('#tabel-pd').DataTable().ajax.reload(null, false);

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


function HapusPd(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");
    var valid = $(elem).data("valid");

    if (valid == 1) {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Data telah diverifikasi',
            timer: 3000,
        })
    } else {
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
                url: BASE_URL + 'penyadapan/delete_pd/',
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
                    $('#tabel-pd').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    }
}

function VerifPd(elem) {
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
            url: BASE_URL + 'penyadapan/verif/',
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
                $('#tabel-pd').DataTable().ajax.reload(null, false);
            },
            error: function(xhr, ajaxOptions, thrownError) {}
        });
    });
}

function BukaValidPd(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");
        var edoc = $(elem).data("edoc");
        swal({
            title: 'Batalkan Validais',
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
                url: BASE_URL + 'penyadapan/buka_valid/',
                type: "POST",
                data: {

                    id: id,
                    edoc: edoc
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Validasi',
                        timer: 2000,
                    })
                    $('#tabel-pd').DataTable().ajax.reload(null, false);
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