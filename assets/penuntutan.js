$(document).ready(function () {

    /* Formatting function for row details - modify as you need */
    //clear data modal
    $("#modal-tambah-tdw").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-tambah-pn").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edit-st").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-verif-pn").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-tdw").on('hide.bs.modal', function (e) {
        $('#tabel-tdw').dataTable().fnClearTable();
        $('#tabel-tdw').dataTable().fnDestroy();

    });

    $("#modal-reupload-smohon-st").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-lappolintel-st").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-penetapan-st").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-sp-st").on('hide.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

    function format(data) {
        // `d` is the original data object for the row
        if (data.updated_at_sita == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_sita + ' Oleh : ' + data.create_by_sita + '</small></td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_sita + ' Oleh : ' + data.create_by_sita + '| Diedit pada : ' + data.updated_at_sita + ' Oleh : ' + data.update_by_sita + '</small></td>' +
                '</tr>' +
                '</table> ';
        }

    }

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
    var table = $('#tabel-pn').DataTable({
        destroy: true,
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
            "url": BASE_URL + "/penuntutan/json_pn",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "urut_pn",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function (data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left">Bab Penyidik : ' + data.no_bab + '<br>Pelimpahan : ' + data.no_pelimpahan + '<br>Surat Dakwaan : ' + data.no_srt_dakwaan + '<br><span class="badge badge-warning ">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        if (data.edoc_tuntutan == null) {
                            return '<div class="text-left">Bab Penyidik : ' + data.no_bab + '<br>Pelimpahan : ' + data.no_pelimpahan + '<br>Surat Dakwaan : ' + data.no_srt_dakwaan + '<br>Surat Tuntutan : ' + data.no_srt_tuntutan +
                                '<br><span class="badge badge-info ">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                                '<br> Oleh : ' + data.verif_by +
                                '</div>'
                        } else {
                            return '<div class="text-left">Bab Penyidik : ' + data.no_bab + '<br>Pelimpahan : ' + data.no_pelimpahan + '<br>Surat Dakwaan : ' + data.no_srt_dakwaan + '<br>Surat Tuntutan : ' + data.no_srt_tuntutan +
                                '<br><span class="badge badge-info ">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                                '<br> Oleh : ' + data.verif_by +
                                '</div>'
                        }

                    } else if (data.validasi == 2) {
                        return '<div class="text-left">Bab Penyidik : ' + data.no_bab + '<br>Pelimpahan : ' + data.no_pelimpahan + '<br>Surat Dakwaan : ' + data.no_srt_dakwaan + '<br>Surat Tuntutan : ' + data.no_srt_tuntutan +
                            '<br><span class="badge badge-success ">Selesai</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by +
                            '</div>'
                    }
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    if(data.no_perkara==null){
                        return '<div class="text-center text-danger">No Perkara Belum Ada</div>'
   
                    } else {
                        return '<div class="text-center">' + data.no_perkara + '</div>'

                    }
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-center">' + data.nm_unit + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    if (data.count_tdk == 1) {
                        return '<div class="text-left">Jumlah Terdakwa : ' + data.count_tdk + '<br>' + data.terdakwa1 +
                            '<br><a class="daftar-tdw" href="#"  data-toggle="modal" data-target="#modal-tdw" data-id="' + data.id_pn + '" > Lihat Daftar</i></a>' +

                            '</div>'
                    } else if (data.count_tdk == 0) {
                        return '<div class="text-center">Belum ada Terdakwa</div>'
                    } else {
                        return '<div class="text-left">Jumlah Terdakwa : ' + data.count_tdk + '<br>' + data.terdakwa1 + ' dkk' +
                            '<br><a class="daftar-tdw" href="#"  data-toggle="modal" data-target="#modal-tdw" data-id="' + data.id_pn + '" > Lihat Daftar</i></a>' +

                            '</div>'
                    }

                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    if (AKSES != 4) {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Edoc Pelimpahan <a href="' + BASE_URL + 'file/pn/' + data.edoc_pelimpahan + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Edoc Dakwaan <a href="' + BASE_URL + 'file/pn/' + data.edoc_dakwaan + '" target="_blank" > [Lihat]</i></a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            if (data.edoc_tuntutan == null) {
                                return '<div class="text-left">' +
                                    '- Edoc Pelimpahan <a href="' + BASE_URL + 'file/pn/' + data.edoc_pelimpahan + '" target="_blank" > [Lihat]</i></a>' +
                                    '<br>- Edoc Dakwaan <a href="' + BASE_URL + 'file/pn/' + data.edoc_dakwaan + '" target="_blank" > [Lihat]</i></a>' +
                                    '<br><div class="btn-group">' +
                                    '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-edoc-tn" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" >+ Edoc Tuntutan</button>' +
                                    '</div>' +
                                    '</div>'
                            } else {
                                return '<div class="text-left">' +
                                    '- Edoc Pelimpahan <a href="' + BASE_URL + 'file/pn/' + data.edoc_pelimpahan + '" target="_blank" > [Lihat]</i></a>' +
                                    '<br>- Edoc Dakwaan <a href="' + BASE_URL + 'file/pn/' + data.edoc_dakwaan + '" target="_blank" > [Lihat]</i></a>' +
                                    '<br><div class="btn-group">' +
                                    '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-edoc-tn" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" >+ Edoc Tuntutan</button>' +
                                    '</div>' +
                                    '</div>'
                            }

                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Edoc Pelimpahan <a href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Edoc Dakwaan <a href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '</div>'
                        }
                    } else {
                        return ''
                    }
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    if (AKSES == 3 || AKSES == 2 || AKSES == 1) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="BukaValidSt(this)" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" data-edoc="' + data.verif_doc + '" >Batalkan Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerifPn(this)"data-id="' + data.id_pn + '" data-edoc="' + data.verif_doc + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="ModalVerifPn(this)" data-id="' + data.id_pn + '" data-pn="' + data.edoc_tuntutan + '" >Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="VerifPn(this)"  data-id="' + data.id_pn + '"  >Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    } else if (AKSES == 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-st" data-id="' + data.id_ijin_sita + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="HapusPn(this)" data-id="' + data.id_pn + '" data-edoc1="' + data.edoc_pelimpahan + '" data-edoc2="' + data.edoc_dakwaan + '" >Hapus</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    } else if (AKSES == 5) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-st" data-id="' + data.id_ijin_sita + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="HapusPn(this)" data-id="' + data.id_pn + '" data-edoc1="' + data.edoc_pelimpahan + '" data-edoc2="' + data.edoc_dakwaan + '" >Hapus</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="TambahTdw(this)"  data-id="' + data.id_pn + '" data-bab="' + data.no_bab + '" data-limpah="' + data.no_pelimpahan + '" data-dakwa="' + data.no_srt_dakwaan + '">+ Terdakwa</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    }
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
    $('#tabel-ijinsita tbody').on('click', 'td.details-control', function () {
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
    $('#filter-table-st').on('change', function () {
        table.search(this.value).draw();
    });
});

//klik get id untuk tbl barang
$('#tabel-pn').on('click', '.daftar-tdw', function () {
    var id = $(this).data('id');

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
    var table = $('#tabel-tdw').DataTable({
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
            "url": BASE_URL + "/penuntutan/json_tdw/" + id,
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "urut_tdw",
                "orderable": true,

            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_tdw + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nik_tdw + '</div>'

                }
            },

            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-sm" onClick="HapusTdw(this)" data-id="' + data.id_tdw + '" >Hapus</button>' +
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
//tambah sita
$('#form-tambah-pn').on('submit', function (e) {
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
    var postData = new FormData($("#form-tambah-pn")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penuntutan/tambah_pn",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
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

                $('#modal-tambah-pn').modal('hide');
                $('#disclaimerPn').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-pn').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
//get data edit
$('#tabel-ijinsita').on('click', '.edit', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'ijinsita/get_id_ijin_sita/' + id,
        dataType: "JSON",
        async: true,
        success: function (data) {
            $('#id_ijin_sita_edit').val(data['id_ijin_sita']);
            $('#validasi_st').val(data['validasi']);
            $('#no_smohon_sita_edit').val(data['no_smohon_sita']);
            $('#unit_st_edit').val(data['id_unit']);
        }
    });

});

//edit sita
$('#form-edit-st').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-st")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita/edit_st",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
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
                title: 'Update',
                text: 'Berhasil Simpan Data',
                timer: 2000,
            })
            // BERSIHKAN FORM MODAL


            $('#modal-edit-st').modal('hide');
            // TUTUP MODAL
            $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
        },
        error: function (data) {

            swal({
                type: 'warning',
                title: 'Update',
                text: 'Gagal Simpan Data',
                timer: 2000,
            })
            // BERSIHKAN FORM MODAL


            $('#modal-edit-st').modal('hide');
            // TUTUP MODAL
            $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});


//tambah barang aksi
$('#form-tambah-tdw').on('submit', function (e) {

    var postData = new FormData($("#form-tambah-tdw")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penuntutan/tambah_tdw",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
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
                text: 'Berhasil Simpan Data',
                timer: 2000,
            })
            $('#modal-tambah-tdw').modal('hide');
            // TUTUP MODAL
            $('#tabel-tdw').DataTable().ajax.reload(null, false);
            $('#tabel-pn').DataTable().ajax.reload(null, false);
        },
        error: function (data) {

            swal({
                type: 'success',
                text: 'Berhasil Simpan Data',
                timer: 2000,
            })
            $('#modal-tambah-tdw').modal('hide');
            // TUTUP MODAL
            $('#tabel-pn').DataTable().ajax.reload(null, false);
        },
    })
    return false;
});



//AMBIL DATA EDIT PG
$('#tabel-ijinsita').on('click', '.detail', function () {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'ijinsita/get_id_ijin_sita/' + id,
        dataType: "JSON",
        async: true,
        success: function (data) {
            document.getElementById('d1').innerHTML = data.no_smohon_sita;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_smohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d4').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d5').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_penetapan + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d5b').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_spdp + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d6').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita/' + data.edoc_sp + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });

});



//REUPLOAD SMOHON
$('#tabel-ijinsita').on('click', '.reupload-s-mohon', function () {
    var id = $(this).data('id');
    $('#id_edoc1').val(id);

});
//REUPLOAD LAPPOLINTEL
$('#tabel-ijinsita').on('click', '.reupload-lap-pol-intel', function () {
    var id = $(this).data('id');
    $('#id_edoc2').val(id);
});

//REUPLOAD LAPPOLINTEL
$('#tabel-ijinsita').on('click', '.reupload-penetapan', function () {
    var id = $(this).data('id');
    $('#id_edoc3').val(id);
});

$('#tabel-ijinsita').on('click', '.reupload-sp', function () {
    var id = $(this).data('id');
    $('#id_edoc4').val(id);
});

$('#form-edoc1-st').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-st")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita/reupload_smohon",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
            if (data.error) {
                swal({
                    type: 'warning',
                    title: 'Gagal Simpan Data',
                    text: 'Format atau Ukuran File tidak sesuai',
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

                $('#modal-reupload-smohon-st').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#form-edoc2-st').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-st")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita/reupload_lap_pol_intel",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
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

                $('#modal-reupload-lappolintel-st').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc3-st').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc3-st")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita/reupload_penetapan",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
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

                $('#modal-reupload-penetapan-st').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc4-st').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc4-st")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita/reupload_sp",
        processData: false,
        contentType: false,
        data: postData, //penggunaan FormData
        //  AMBIL VARIABEL
        dataType: "JSON",
        beforeSend: function () {
            // Show image container
            swal({
                title: "Mohon Tunggu",
                showConfirmButton: false,
            });
        },
        success: function (data) {
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

                $('#modal-reupload-sp-st').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function HapusPn(elem) {
    var id = $(elem).data("id");
    var edoc1 = $(elem).data("edoc1");
    var edoc2 = $(elem).data("edoc2");
    swal({
        title: 'Hapus',
        text: 'Anda Yakin Hapus Data Ijin Sita ?',
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
            url: BASE_URL + 'penuntutan/delete_pn/',
            type: "POST",
            data: {

                id: id,
                edoc1: edoc1,
                edoc2: edoc2,
            },
            success: function () {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-pn').DataTable().ajax.reload(null, false);
            },
            error: function (xhr, ajaxOptions, thrownError) {


            }
        });
    });


}

function ValidSt(elem) {
    if ((AKSES == 1) || (AKSES == 2) || (AKSES == 3)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");

        swal({
            title: 'Validasi',
            text: 'Yakin untuk Verifikasi ' + srt + ' ?',
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
                url: BASE_URL + 'ijinsita/valid/',
                type: "POST",
                data: {

                    id: id,
                },
                success: function () {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data diverifikasi',
                        timer: 2000,
                    })
                    $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
                },
                error: function (xhr, ajaxOptions, thrownError) {


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

function BukaVerifPn(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        swal({
            title: 'Batalkan Verifikasi',
            text: 'Yakin untuk Batalkan Verifikasi ?',
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
                url: BASE_URL + 'penuntutan/buka_verif/',
                type: "POST",
                data: {

                    id: id,
                },
                success: function () {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Validasi',
                        timer: 2000,
                    })
                    $('#tabel-pn').DataTable().ajax.reload(null, false);
                },
                error: function (xhr, ajaxOptions, thrownError) {


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

function BukaValidSt(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");
        var edoc = $(elem).data("edoc");
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
        }, function (isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: BASE_URL + 'ijinsita/buka_valid/',
                type: "POST",
                data: {

                    id: id,
                    edoc: edoc
                },
                success: function () {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Validasi',
                        timer: 2000,
                    })
                    $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
                },
                error: function (xhr, ajaxOptions, thrownError) {


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


function HapusTdw(elem) {
    var id = $(elem).data("id");


    swal({
        title: 'Hapus',
        text: 'Anda Yakin Hapus ?',
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
            url: BASE_URL + 'penuntutan/delete_tdw/',
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
                $('#tabel-tdw').DataTable().ajax.reload(null, false);
                $('#tabel-pn').DataTable().ajax.reload(null, false);

            },
            error: function (xhr, ajaxOptions, thrownError) {


            }
        });
    });
}



function VerifPn(elem) {
    var id = $(elem).data("id");
    $('#ModalPerkara').modal('show');
    $('#id_pn_verif').val(id);
}

function ModalVerifPn(elem) {
    var id = $(elem).data("id");
    var pn = $(elem).data("pn");
    if (pn != null) {
        $('#modal-verif-pn').modal('show');

    } else {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Data Edoc Tuntutan belum diupload',
            timer: 3000,
        })
    }

}

function TambahTdw(elem) {
    var id = $(elem).data("id");
    var bab = $(elem).data("bab");
    var limpah = $(elem).data("limpah");
    var dakwa = $(elem).data("dakwa");

    $('#modal-tambah-tdw').modal('show');
    $('#id_pn_tdw').val(id);
    document.getElementById('pelimpahan_info').innerHTML = limpah;
    document.getElementById('no_bab_info').innerHTML = bab;
    document.getElementById('dakwa_info').innerHTML = dakwa;



}

$('#FormVerifPerkara').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#FormVerifPerkara")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penuntutan/verif",
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
            $('#ModalPerkara').modal('hide');
            $('#tabel-pn').DataTable().ajax.reload(null, false);
        },
        error: function (data) {

            swal({
                type: 'warning',
                title: 'Gagal',
                text: 'Gagal Simpan Data',
                timer: 2000,
            })
            $('#tabel-pn').DataTable().ajax.reload(null, false);

        },
    })
    return false;
});
