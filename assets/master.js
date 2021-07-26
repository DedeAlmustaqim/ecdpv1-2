$(document).ready(function () {
    /* Formatting function for row details - modify as you need */

    $("#modal-set-op").on('hide.bs.modal', function (e) {
        $('#tabel-set-op').dataTable().fnClearTable();
        $('#tabel-set-op').dataTable().fnDestroy();

    });
    $("#modal-tambah-op").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-tambah-unit").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

    $('#FormUbahPass').on('submit', function (e) {

        var postData = new FormData($("#FormUbahPass")[0]);
        //var postData = new FormData($("#form-tambah-smohongd")[1]);
        $.ajax({
            type: "post",
            "url": BASE_URL + "master/ubah_pass",
            processData: false,
            contentType: false,
            data: postData, //penggunaan FormData
            //  AMBIL VARIABEL
            dataType: "JSON",
            success: function (data) {
                swal({
                    type: 'success',
                    title: 'Simpan',
                    text: 'Berhasil Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


                $('#ModalUbahPass').modal('hide');

            },
            error: function (data) {

                swal({
                    type: 'warning',
                    title: 'Gagal',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


                $('#ModalUbahPass').modal('hide');

            },
        })
        return false;
    });

    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
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
    var table = $('#tabel-unit').DataTable({
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [0, 'asc']
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
            "url": BASE_URL + "/master/json_unit",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id_unit",
                "orderable": true,

            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.nm_unit + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.nm_pimpinan + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.nrp_nip + '</div>'
                }
            },

            {
                "data": "id_unit",
                "data": "nm_unit",

                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>' +
                        '<div class="dropdown-menu animated flipIn">' +
                        '<a href="javascript:void(0);" class="dropdown-item op" data-toggle="modal" data-target="#modal-set-op" data-id="' + data.id_unit + '" data-nmunit="' + data.nm_unit + '" >Set Operator</a>' +
                        '<a href="javascript:void(0);" class="dropdown-item edit" data-toggle="modal" data-target="#modal-edit-unit" data-id="' + data.id_unit + '" >Edit</a>' +
                        '<a class="dropdown-item"   onClick="HapusUnit(this)" data-id="' + data.id_unit + '" data-unit="' + data.nm_unit + '">Hapus</a>' +
                        '</div>'
                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    var table = $('#tabel-admin').DataTable({
        "columnDefs": [{
            "visible": false,

        }],
        "order": [
            [0, 'asc']
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
            "url": BASE_URL + "/user/json_admin",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "id_user",
                "orderable": true,

            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.username + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.nama + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.nip + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.email + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="text-left">' + data.hak_akses + '</div>'
                }
            },
            {

                "orderable": false,
                "data": function (data, type, row, meta, dataToSet) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>' +
                        '<div class="dropdown-menu animated flipIn">' +
                        '<a href="javascript:void(0);" class="dropdown-item edit" data-toggle="modal" data-target="#modal-edit-user" data-id="' + data.id_user + '" >Edit</a>' +
                        '<a class="dropdown-item"   onClick="HapusUser(this)" data-id="' + data.id_user + '">Hapus</a>' +
                        '</div>&nbsp;' +
                        '<div class="btn-group"><a class="btn btn-default btn-sm" onClick="ResetPassUser(this)" data-id="' + data.id_user + '">Reset</a></div>'
                }
            },


        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });
});
// Order by the grouping
//TAMBAH UNIT
$('#form-tambah-unit').on('submit', function () {

    var nm_unit = $('#nm_unit').val();
    var nm_pimpinan = $('#nm_pimpinan').val();
    var nrp_nip = $('#nrp_nip').val();


    $.ajax({
        type: "post",
        "url": BASE_URL + "master/tambah_unit",
        data: {

            nm_unit: nm_unit,
            nm_pimpinan: nm_pimpinan,
            nrp_nip: nrp_nip
        }, //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
            swal({
                type: 'success',
                title: 'Simpan Data',
                text: 'Berhasil Simpan data',
                timer: 2000,
            })
            $('#nm_unit').val('');
            $('#nm_pimpinan').val('');
            $('#nrp_nip').val('');
            $('#modal-tambah-unit').modal('hide');
            // TUTUP MODAL
            $('#tabel-unit').DataTable().ajax.reload(null, false);
        },
        error: function (data) {
            swal({
                type: 'warning',
                title: 'Gagal',
                text: 'Data tidak dismpan',
                timer: 2000,
            })
            //$('#nm_unit').val('');
            //$('#nm_pimpinan').val('');
            //$('#nrp_nip').val('');
            //$('#modal-tambah-unit').modal('hide');
            // TUTUP MODAL
            //$('#tabel-unit').DataTable().ajax.reload(null,false);
        }
    })
    return false;
});


//AMBIL DATA EDIT UNIT
$('#tabel-unit').on('click', '.edit', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'master/get_id_unit/' + id,
        dataType: "JSON",
        success: function (data) {
            $('#id_unit').val(data['id_unit']);
            $('#nm_unit_edit').val(data['nm_unit']);
            $('#nm_pimpinan_edit').val(data['nm_pimpinan']);
            $('#nrp_nip_edit').val(data['nrp_nip']);
        }
    });

});

//EDIT  AKSI
$('#form-edit-unit').on('submit', function () {
    var id_unit = $('#id_unit').val();
    var nm_unit_edit = $('#nm_unit_edit').val();
    var nm_pimpinan_edit = $('#nm_pimpinan_edit').val();
    var nrp_nip_edit = $('#nrp_nip_edit').val();
    $.ajax({
        type: "post",
        "url": BASE_URL + "master/edit_unit",
        data: {
            id_unit: id_unit,
            nm_unit_edit: nm_unit_edit,
            nm_pimpinan_edit: nm_pimpinan_edit,
            nrp_nip_edit: nrp_nip_edit
        }, //  AMBIL VARIABEL
        dataType: "JSON",
        success: function (data) {
            swal({
                type: 'success',
                title: 'Simpan Data',
                text: 'Data Berhasil dismpan',
                timer: 2000,
            })
            // BERSIHKAN FORM MODAL
            $('#id_unit').val('');
            $('#nm_unit_edit').val('');
            $('#nm_pimpinan_edit').val('');
            $('#nrp_nip_edit').val('');
            $('#modal-edit-unit').modal('hide');
            // TUTUP MODAL
            $('#tabel-unit').DataTable().ajax.reload(null, false);
        },
        error: function (data) {
            swal({
                type: 'warning',
                title: 'Gagal',
                text: 'Gagal Simpan data',
                timer: 2000,
            })
        }
    })
    return false;
});





function HapusUnit(elem) {
    var id = $(elem).data("id");
    var unit = $(elem).data("unit");
    swal({
        title: 'Hapus.?',
        text: unit,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'master/delete_unit/' + id,
            type: "POST",
            dataType: "HTML",
            success: function () {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-unit').DataTable().ajax.reload(null, false);
            },
            error: function () {
                swal({
                    type: 'warning',
                    title: 'Gagal',
                    text: 'Sudah ada Data, Unit tidak bisa dihapus',
                    timer: 3000,
                })

            }
        });
    });

}


function HapusUser(elem) {
    var id = $(elem).data("id");
    var unit = $(elem).data("unit");
    swal({
        title: 'Hapus.?',
        text: unit,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'user/delete/' + id,
            type: "POST",
            dataType: "HTML",
            success: function () {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-admin').DataTable().ajax.reload(null, false);
            },
            error: function () {
                swal({
                    type: 'warning',
                    title: 'Gagal',
                    text: 'Sudah ada Data, Unit tidak bisa dihapus',
                    timer: 3000,
                })

            }
        });
    });

}

function TambahOp(elem) {
    var id = $(elem).data("id");
    $('#id_unit_op').val(id);
}
$('#form-tambah-op').on('submit', function (e) {

    var postData = new FormData($("#form-tambah-op")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "master/tambah_op",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        success: function (data) {
            swal({
                type: 'success',
                title: 'Simpan',
                text: 'Berhasil Simpan Data',
                timer: 2000,
            })
            // BERSIHKAN FORM MODAL


            $('#modal-tambah-op').modal('hide');
            // TUTUP MODAL
            $('#tabel-set-op').DataTable().ajax.reload(null, false);
            $('#tabel-unit').DataTable().ajax.reload(null, false);
        },
        error: function (data) {

            swal({
                type: 'warning',
                title: 'Gagal',
                text: 'Gagal Simpan Data',
                timer: 2000,
            })
            // BERSIHKAN FORM MODAL


            $('#tabel-set-op').DataTable().ajax.reload(null, false);
            $('#tabel-unit').DataTable().ajax.reload(null, false);
        },
    })
    return false;
});


$('#tabel-unit').on('click', '.op', function () {
    var id = $(this).data('id');
    var nmunit = $(this).data('nmunit');

    document.getElementById('nm-unit').innerHTML = nmunit;
    document.getElementById('tambah-op').innerHTML = '<div class="btn-group">' +
        '<button type="button" onClick="TambahOp(this)" data-id="' + id + '" class="btn btn-block btn-outline-info tambah" data-toggle="modal" data-target="#modal-tambah-op">+ Operator</button>' +
        '</div>';



    var table = $('#tabel-set-op').DataTable({
        "columnDefs": [{
            "visible": false,

        }],
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false,
        "order": [
            [0, 'asc']
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
            "url": BASE_URL + "master/json_op/" + id,
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "created_at",
                "orderable": true,

            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.username + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nama + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nrp_nip + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.email + '</div>'

                }
            },


            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-sm" onClick="HapusOp(this)" data-nm="' + data.nama + '"  data-id="' + data.id_user + '" >Edit</button>' +
                        '&nbsp;<button type="button" class="btn btn-default btn-sm" onClick="HapusOp(this)" data-nm="' + data.nama + '"  data-id="' + data.id_user + '" >Reset</button>' +
                        '&nbsp;<button type="button" class="btn btn-default btn-sm" onClick="HapusOp(this)" data-nm="' + data.nama + '"  data-id="' + data.id_user + '" >Hapus</button>' +
                        '</div>&nbsp;'
                }
            },

        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

});

function HapusOp(elem) {
    var id = $(elem).data("id");
    var nm = $(elem).data("nm");
    swal({
        title: 'Hapus.?',
        text: nm,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'master/delete_op/',
            type: "POST",
            data: {

                id: id,

            },
            success: function () {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-set-op').DataTable().ajax.reload(null, false);
            },
            error: function () {
                swal({
                    type: 'warning',
                    title: 'Gagal',
                    text: 'Operator Gagal dihapus',
                    timer: 3000,
                })

            }
        });
    });

}

function ResetPassUser(elem) {
    var id = $(elem).data("id");
    swal({
        title: 'Yakin Reset Password.?',
        text: '',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor  : '#DD6B55',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'YA',

        closeOnConfirm: false,
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: BASE_URL + 'user/reset_pass/',
            type: "POST",
            data: {

                id: id,

            },
            success: function () {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-admin').DataTable().ajax.reload(null, false);
            },
            error: function () {
                swal({
                    type: 'warning',
                    title: 'Gagal',
                    text: 'Operator Gagal dihapus',
                    timer: 3000,
                })

            }
        });
    });

}

$('#form-tambah-user').on('submit', function (e) {

    e.preventDefault();
    var postData = new FormData($("#form-tambah-user")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "user/tambah_user",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        success: function () {
            swal({
                type: 'success',
                title: 'Berhasil',
                text: 'Data dihapus',
                timer: 2000,
            })
            $('#modal-tambah-user').modal('hide');
            $('#tabel-admin').DataTable().ajax.reload(null, false);
        },
        error: function () {
            swal({
                type: 'warning',
                title: 'Gagal Simpan Data',
                text: '',
                timer: 3000,
            })

        },

    })
    return false;
});

$('#tabel-admin').on('click', '.edit', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'user/get_user/' + id,
        dataType: "JSON",
        success: function (data) {
            $('#id_user').val(data['id_user']);
            $('#username_edit').val(data['username']);
            $('#nm_user_edit').val(data['nama']);
            $('#nip_user_edit').val(data['nip']);
            $('#email_user_edit').val(data['email']);
            $('#hak_akses_edit').val(data['id_akses']);
        }
    });

});

$('#form-edit-user').on('submit', function (e) {

    e.preventDefault();
    var postData = new FormData($("#form-edit-user")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "user/edit_user",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        success: function () {
            swal({
                type: 'success',
                title: 'Berhasil',
                text: 'Data dihapus',
                timer: 2000,
            })
            $('#modal-edit-user').modal('hide');
            $('#tabel-admin').DataTable().ajax.reload(null, false);
        },
        error: function () {
            swal({
                type: 'warning',
                title: 'Gagal Simpan Data',
                text: '',
                timer: 3000,
            })

        },

    })
    return false;
});
