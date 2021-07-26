$(document).ready(function() {


    $("#modal-tambah-penahanan").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();

    });
    $("#modal-edit-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-verif-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-edoc1-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc2-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc3-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc4-ph-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });


    function format(data) {
        // `d` is the original data object for the row
        if (data.updated_at_ph == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_ph + ' Oleh : ' + data.create_by_ph + '</small></td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_ph + ' Oleh : ' + data.create_by_ph + '| Diedit pada : ' + data.updated_at_ph + ' Oleh : ' + data.update_by_ph + '</small></td>' +
                '</tr>' +
                '</table> ';
        }
    }
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
    var table = $('#tabel-penahanan-p').DataTable({

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
            "url": BASE_URL + "/penahanan_p/json_penahanan",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [{
                "data": "urut_penahanan",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {

                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_ph + '<br><span class="badge badge-warning">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_ph +
                            '<br> <span class="badge badge-info ">Dalam Proses</span>&nbsp;<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by +
                            '</div>'

                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_ph +
                            '<br> <span class="badge badge-success ">Selesai</span>&nbsp;<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by +
                            '</div>'

                    }

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-center">' + data.nm_unit + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 0) {
                            if (data.riwayat == 1) {
                                return '<div class="text-left">' +
                                    'Perpanjangan Penuntutan <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_r2 + '" target="_blank" > [Lihat]</i></a>'
                                    //'<a class="edoc1-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc1-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>'

                            } else if (data.riwayat == 0) {
                                return '<div class="text-center"><div class="btn-group">' +
                                    '<button type="button" class="btn btn-default btn-sm riwayat_p" data-toggle="modal" data-target="#modal-riwayat-p" data-id="' + data.id_penahanan + '" data-verif="' + data.validasi + '"> + Edoc </button>' +
                                    '</div>&nbsp</div>'
                            }
                        } else {
                            return '<div class="text-left">' +
                                'Perpanjangan Penuntutan<a href="' + BASE_URL + 'file/ph-p/' + data.edoc_r2 + '" target="_blank" > [Lihat]</i></a>'
                        }
                    } else {
                        if (data.validasi == 0) {
                            if (data.riwayat == 1) {
                                return '<div class="text-left">' +
                                    '- Penahanan Penyidik <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_r2 + '" target="_blank" > [Lihat]</i></a>' +
                                    '<a class="edoc1-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc1-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>'

                            } else if (data.riwayat == 0) {
                                return '<div class="text-center"><div class="btn-group">' +
                                    '<button type="button" class="btn btn-default btn-sm riwayat_p" data-toggle="modal" data-target="#modal-riwayat-p" data-id="' + data.id_penahanan + '" data-verif="' + data.validasi + '"> + Edoc </button>' +
                                    '</div>&nbsp</div>'
                            }
                        } else {
                            return '<div class="text-left">' +
                                'Perpanjangan Penuntut Umum <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_r2 + '" target="_blank" > [Lihat]</i></a>'
                        }
                    }


                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left">' +
                            '- Surat Permohonan <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_permohonan_ph + '" target="_blank" > [Lihat]</i></a>' +
                            '<a class="edoc1-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc1-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>' +
                            /*
                            '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                            '<a class="edoc2-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc2-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>' +
                            '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/ph-p/' + data.edoc_penetapan_ter + '" target="_blank" > [Lihat]</a>' +
                            '<a class="edoc3-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc3-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>' +
                            '<br>- Surat SPDP <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                            '<a class="edoc4-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc4-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>' +
                            '<br>- Resume <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_resume + '" target="_blank" > [Lihat]</a>' +
                            '<a class="edoc5-ph-p" href="#"  data-toggle="modal" data-target="#modal-edoc5-ph-p" data-id="' + data.id_penahanan + '" > [Reupload]</a>' +
                            */
                            '</div>'
                    } else if (data.validasi == 1) {
                        return '<div class="text-left">' +
                            '- Surat Permohonan <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_permohonan_ph + '" target="_blank" > [Lihat]</i></a>' +
                            /*
                            '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                            '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/ph-p/' + data.edoc_penetapan_ter + '" target="_blank" > [Lihat]</a>' +
                            '<br>- Surat SPDP <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                            '<br>- Resume <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_resume + '" target="_blank" > [Lihat]</a>' +
                            */
                            '</div>'
                    } else if (data.validasi == 2) {
                        return '<div class="text-left">' +
                            '- Surat Permohonan <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_permohonan_ph + '" target="_blank" > [Lihat]</i></a>' +
                            /*
                            '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                            '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/ph-p/' + data.edoc_penetapan_ter + '" target="_blank" > [Lihat]</a>' +
                            '<br>- Surat SPDP <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                            '<br>- Resume <a href="' + BASE_URL + 'file/ph-p/' + data.edoc_resume + '" target="_blank" > [Lihat]</a>' +
                           */
                            '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                            '<a  href="' + BASE_URL + 'file/ph-p/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +

                            '</div>'
                    }
                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm " onClick="BukaValidPhp(this)" data-srt="' + data.no_smohon_ph + '" data-id="' + data.id_penahanan + '"  data-edoc="' + data.verif_doc + '">Batalkan Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else
                        if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm " onClick="BukaVerifPhP(this)" data-srt="' + data.no_smohon_ph + '" data-id="' + data.id_penahanan + '"  >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-ph-p" data-srt="' + data.no_smohon_ph + '" data-id="' + data.id_penahanan + '" data-rw="' + data.riwayat + '" >Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                //'<div class="btn-group">' +
                                //'<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-ph-p" data-id="' + data.id_penahanan + '">Edit</button>' +
                                //'</div>&nbsp;' +
                                //'<div class="btn-group">' +
                                //'<button type="button" class="btn btn-danger btn-sm" onClick="HapusPhP(this)" data-srt="' + data.no_smohon_ph + '"  data-id="' + data.id_penahanan + '" data-smohon="' + data.edoc_permohonan_ph + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan_ter + '" data-spdp="' + data.edoc_spdp + '"  data-valid="' + data.validasi + '" data-resume="' + data.edoc_resume + '">Hapus</button>' +
                                //'</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm " onClick="VerifPhP(this)" data-srt="' + data.no_smohon_ph + '" data-id="' + data.id_penahanan + '"  data-rw="' + data.riwayat + '">Verifikasi</button>' +
                                '</div>' +
                                '</div>'
                        }
                    } else if (AKSES == 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-ph-p" data-id="' + data.id_penahanan + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-ph-p" data-id="' + data.id_penahanan + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="HapusSt(this)" data-srt="' + data.no_smohon_sita + '"  data-id="' + data.id_psita + '" data-smohon="' + data.edoc_smohon_sita + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan + '" data-sp="' + data.edoc_sp + '" data-valid="' + data.validasi + '">Hapus</button>' +
                                '</div>&nbsp;' +
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

    $('#tabel-penahanan-p tbody').on('click', 'td.details-control', function() {
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

    /*$('#tabel-psita').on('init.dt', function(e, settings){
        var api = new $.fn.dataTable.Api( settings );
        api.rows().every( function () {
           var tr = $(this.node());
           this.child(format(this.data())).show();
           tr.addClass('shown');
        });
     });*/

    $('#filter-table-ph-p').on('change', function() {
        table.search(this.value).draw();
    });
});

//klik get id untuk tbl barang

//tambah sita
$('#form-tambah-penahanan-p').on('submit', function(e) {
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
    var postData = new FormData($("#form-tambah-penahanan-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/tambah_penahanan",
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

                $('#modal-tambah-penahanan-p').modal('hide');
                $('#disclaimerPhP').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
//get data edit
$('#tabel-penahanan-p').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penahanan_p/get_ph/' + id,
        dataType: "JSON",
        async: true,

        success: function(data) {
            $('#id_ph').val(data['id_penahanan']);
            $('#no_smohon_ph_edit').val(data['no_smohon_ph']);
            $('#unit_ph_edit').val(data['id_unit']);
            $('#jns_ph_edit').val(data['jns_ph']);
            $('#nm_ph_edit').val(data['nm_ph']);
            $('#nik_ph_edit').val(data['nik_ph']);
            $('#t_lahir_ph_edit').val(data['t_lahir_ph']);
            $('#tgl_edit').val(data['tgl']);
            $('#bln_edit').val(data['bln']);
            $('#ta_edit').val(data['ta']);
            $('#jk_ph_edit').val(data['jk_ph']);
            $('#agama_ph_edit').val(data['agama_ph']);
            $('#pekerjaan_ph_edit').val(data['pekerjaan_ph']);
            $('#kebangsaan_ph_edit').val(data['kebangsaan_ph']);
            $('#alamat_ph_edit').val(data['alamat_ph']);
        }
    });

});

//edit sita
$('#form-edit-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/edit_ph",
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
            swal({
                    type: 'success',
                    title: 'Update',
                    text: 'Berhasil Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-ph-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
        },
        error: function(data) {

            swal({
                    type: 'warning',
                    title: 'Update',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-ph-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-penahanan').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

//AMBIL DATA EDIT PG
$('#tabel-penahanan-p').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penahanan_p/get_ph/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_ph;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/ph-p/' + data.edoc_permohonan_ph + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d7').innerHTML = data.jns_ph;
            document.getElementById('d8a').innerHTML = data.nm_ph;
            document.getElementById('d8').innerHTML = data.nik_ph;
            document.getElementById('d9').innerHTML = data.t_lahir_ph;
            document.getElementById('d10').innerHTML = data.tgl + '/' + data.bln + '/' + data.ta;
            document.getElementById('d11').innerHTML = data.jk_ph;
            document.getElementById('d12').innerHTML = data.alamat_ph;
            document.getElementById('d13').innerHTML = data.agama_ph;
            document.getElementById('d14').innerHTML = data.pekerjaan_ph;
            document.getElementById('d15').innerHTML = data.kebangsaan_ph;

        }
    });

});

//REUPLOAD SMOHON
$('#tabel-penahanan-p').on('click', '.edoc1-ph-p', function() {
    var id = $(this).data('id');
    $('#id_edoc1').val(id);
});

$('#form-edoc1-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/reupload_smohon",
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

                $('#modal-edoc1-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

//REUPLOAD LAPPOLINTEL
$('#tabel-penahanan-p').on('click', '.edoc2-ph-p', function() {
    var id = $(this).data('id');
    $('#id_edoc2').val(id);
});

$('#form-edoc2-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/reupload_lap_pol_intel",
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

                $('#modal-edoc2-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

//REUPLOAD LAPPOLINTEL
$('#tabel-penahanan-p').on('click', '.edoc3-ph-p', function() {
    var id = $(this).data('id');
    $('#id_edoc3').val(id);
});

$('#form-edoc3-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc3-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/reupload_penetapan",
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

                $('#modal-edoc3-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-penahanan-p').on('click', '.edoc4-ph-p', function() {
    var id = $(this).data('id');
    $('#id_edoc4').val(id);
});

$('#form-edoc4-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc4-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/reupload_spdp",
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

                $('#modal-edoc4-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-penahanan-p').on('click', '.edoc5-ph-p', function() {
    var id = $(this).data('id');
    $('#id_edoc5').val(id);
});

$('#form-edoc5-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc5-ph-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/reupload_resume",
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

                $('#modal-edoc5-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-penahanan-p').on('click', '.riwayat_p', function() {
    var id = $(this).data('id');
    $('#id_r').val(id);
});

$('#form-edoc-r-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc-r-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/edoc_r",
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

                $('#modal-riwayat-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function HapusPhP(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");
    var penetapan = $(elem).data("penetapan");
    var spdp = $(elem).data("spdp");
    var resume = $(elem).data("resume");

    var valid = $(elem).data("valid");

    if (valid == 1) {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Data telah divalidasi',
            timer: 3000,
        })
    } else {
        swal({
            title: 'Hapus',
            text: 'Anda Yakin Hapus Data Perpanjangan Penahanan ' + srt + '?',
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
                url: BASE_URL + 'penahanan_p/delete_ph/',
                type: "POST",
                data: {

                    id: id,
                    smohon: smohon,
                    lap: lap,
                    penetapan: penetapan,
                    spdp: spdp,
                    resume: resume

                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data dihapus',
                        timer: 2000,
                    })
                    $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    }
}


function BukaVerifPh(elem) {
    if ((AKSES == 1) || (AKSES == 2)) {

        var id = $(elem).data("id");
        var srt = $(elem).data("srt");
        swal({
            title: 'Batalkan Validasi',
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
                url: BASE_URL + 'penahanan/buka_verif/',
                type: "POST",
                data: {

                    id: id,
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Validasi',
                        timer: 2000,
                    })
                    $('#tabel-penahanan').DataTable().ajax.reload(null, false);
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

$('#tabel-penahanan-p').on('click', '.verif', function() {
    var id = $(this).data('id');

    $('#id_verif_php').val(id);
});

$('#form-verif-ph-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-ph-p")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penahanan_p/valid",
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

                $('#modal-verif-ph-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function VerifPhP(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var rw = $(elem).data("rw");
    if (rw != 0) {
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
                url: BASE_URL + 'penahanan_p/verif/',
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
                    $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        });
    } else {
        swal({
            type: 'warning',
            title: 'Tidak diijinkan ',
            text: 'Data Edoc Riwayat belum diupload',
            timer: 3000,
        })
    }

}

function BukaVerifPhP(elem) {
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
                url: BASE_URL + 'penahanan_p/buka_verif/',
                type: "POST",
                data: {

                    id: id,
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Batalkan Validasi',
                        timer: 2000,
                    })
                    $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
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

function BukaValidPhp(elem) {
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
                url: BASE_URL + 'penahanan_p/buka_valid/',
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
                    $('#tabel-penahanan-p').DataTable().ajax.reload(null, false);
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