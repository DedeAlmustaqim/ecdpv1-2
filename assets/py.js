$(document).ready(function() {
    /* Formatting function for row details - modify as you need */
    $("#modal-edit-py").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-tambah-py").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-smohon-py").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-lappolintel-py").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-verif-py").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    function format(data) {
        // `d` is the original data object for the row
        if (data.updated_at_py == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td>Dibuat pada : ' + data.created_at_py + ' Oleh : ' + data.create_by_py + '</td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_py + ' Oleh : ' + data.create_by_py + ' | Diedit pada : ' + data.updated_at_py + ' Oleh : ' + data.update_by_py + '</small></td>' +
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
    var table = $('#tabel-py').DataTable({
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
            "url": BASE_URL + "/penyidikan/json_penyidikan",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "urut_py",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_py + '<br><span class="badge badge-warning ">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_py + '<br><span class="badge badge-info ">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date + '<br> Oleh : ' + data.verif_by + '</small></div>'

                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i>&nbsp;' + data.no_smohon_py + '<br><span class="badge badge-success ">Selesai</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date + '<br> Oleh : ' + data.verif_by + '</small></div>'

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
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-reupload-smohon-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-reupload-lappolintel-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-penetapan" href="#"  data-toggle="modal" data-target="#modal-reupload-penetapan-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-spdp" href="#"  data-toggle="modal" data-target="#modal-reupload-spdp-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/py/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-reupload-smohon-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-reupload-lappolintel-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-penetapan" href="#"  data-toggle="modal" data-target="#modal-reupload-penetapan-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-spdp" href="#"  data-toggle="modal" data-target="#modal-reupload-spdp-py" data-id="' + data.id_py + '" > [Reupload]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPDP <a href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/py/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
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
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-py" data-id="' + data.id_py + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="BukaValidPy(this)" data-srt="' + data.no_smohon_py + '" data-id="' + data.id_py + '"  data-edoc="' + data.verif_doc + '">Batalkan Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-py" data-id="' + data.id_py + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerifPy(this)" data-srt="' + data.no_smohon_py + '" data-id="' + data.id_py + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-py"  data-id="' + data.id_py + '" >Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-py" data-id="' + data.id_py + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                /*
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-py" data-id="' + data.id_py + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm" onClick="HapusPy(this)" data-srt="' + data.no_smohon_py + '"  data-id="' + data.id_py + '" data-smohon="' + data.edoc_s_mohon + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan + '" data-spdp="' + data.edoc_spdp + '" data-valid="' + data.validasi + '">Hapus</button>' +
                                '</div>&nbsp;' +
                                */
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="VerifPy(this)"  data-id="' + data.id_py + '" data-srt="' + data.no_smohon_py + '">Verifikasi</button>' +
                                '</div>' +
                                '</div>'
                        }
                    } else if (AKSES == 4) {
                        if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-py" data-id="' + data.id_py + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" onClick="Verify()">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" onClick="Verify()">Hapus</button>' +
                                '</div>&nbsp;' +

                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-py" data-id="' + data.id_py + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-py" data-id="' + data.id_py + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm" onClick="HapusPy(this)" data-srt="' + data.no_smohon_py + '"  data-id="' + data.id_py + '" data-smohon="' + data.edoc_s_mohon + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan + '" data-spdp="' + data.edoc_spdp + '" data-valid="' + data.validasi + '">Hapus</button>' +
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
    $('#tabel-py tbody').on('click', 'td.details-control', function() {
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
    $('#filter-table-py').on('change', function() {
        table.search(this.value).draw();
    });
});



// Order by the grouping

$('#form-tambah-py').on('submit', function(e) {
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
    var postData = new FormData($("#form-tambah-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/tambah_py",
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

                $('#modal-tambah-py').modal('hide');
                $('#disclaimerPy').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },

    })
    return false;
});

$('#form-edit-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/edit_py",
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


            $('#modal-edit-py').modal('hide');
            // TUTUP MODAL
            $('#tabel-py').DataTable().ajax.reload(null, false);
        },
        error: function(data) {

            swal({
                    type: 'warning',
                    title: 'Update',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-py').modal('hide');
            // TUTUP MODAL
            $('#tabel-py').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

//AMBIL DATA EDIT PG
$('#tabel-py').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyidikan/get_id_penyidikan/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_py;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = data.jns_py;
            document.getElementById('d4').innerHTML = data.lok_py;
            document.getElementById('d5').innerHTML = data.pemilik_lok_py;
            document.getElementById('d6a').innerHTML = data.nm_py;
            document.getElementById('d6').innerHTML = data.nik_py;
            document.getElementById('d7').innerHTML = data.t_lahir_py;
            document.getElementById('d8').innerHTML = data.tgl_lahir_py;
            document.getElementById('d9').innerHTML = data.jk_py;
            document.getElementById('d10').innerHTML = data.alamat_py;
            document.getElementById('d11').innerHTML = data.agama_py;
            document.getElementById('d12').innerHTML = data.pekerjaan_py;
            document.getElementById('d13').innerHTML = data.kebangsaan_py;
            document.getElementById('d14').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/py/' + data.edoc_s_mohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d15').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/py/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d16').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/py/' + data.edoc_penetapan + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d17').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/py/' + data.edoc_spdp + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });

});

$('#tabel-py').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'penyidikan/get_id_penyidikan/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            $('#id_py').val(data['id_py']);
            $('#validasi_py').val(data['validasi']);
            $('#no_srt_py_edit').val(data['no_smohon_py']);
            $('#unit_py_edit').val(data['id_unit']);
            $('#jns_py_edit').val(data['jns_py']);
            $('#lok_py_edit').val(data['lok_py']);
            $('#pemilik_lok_py_edit').val(data['pemilik_lok_py']);
            $('#nm_py_edit').val(data['nm_py']);
            $('#nik_py_edit').val(data['nik_py']);
            $('#t_lahir_py_edit').val(data['t_lahir_py']);
            $('#tgl_edit').val(data['tgl']);
            $('#bln_edit').val(data['bln']);
            $('#ta_edit').val(data['ta']);
            $('#jk_py_edit').val(data['jk_py']);
            $('#alamat_py_edit').val(data['alamat_py']);
            $('#agama_py_edit').val(data['agama_py']);
            $('#pekerjaan_py_edit').val(data['pekerjaan_py']);
            $('#kebangsaan_py_edit').val(data['kebangsaan_py']);

        }
    });

});

//REUPLOAD SMOHON
$('#tabel-py').on('click', '.reupload-s-mohon', function() {
    var id = $(this).data('id');
    $('#id_edoc1').val(id);

});
//REUPLOAD LAPPOLINTEL
$('#tabel-py').on('click', '.reupload-lap-pol-intel', function() {
    var id = $(this).data('id');
    $('#id_edoc2').val(id);
});

//REUPLOAD LAPPOLINTEL
$('#tabel-py').on('click', '.reupload-penetapan', function() {
    var id = $(this).data('id');
    $('#id_edoc3').val(id);
});

$('#tabel-py').on('click', '.reupload-spdp', function() {
    var id = $(this).data('id');
    $('#id_edoc4').val(id);
});

$('#form-edoc1-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/reupload_smohon",
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

                $('#modal-reupload-smohon-py').modal('hide');
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#form-edoc2-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/reupload_lap_pol_intel",
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

                $('#modal-reupload-lappolintel-py').modal('hide');
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc3-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc3-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/reupload_s_penetapan",
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

                $('#modal-reupload-penetapan-py').modal('hide');
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc4-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc4-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/reupload_spdp",
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

                $('#modal-reupload-spdp-py').modal('hide');
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function HapusPy(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");
    var penetapan = $(elem).data("penetapan");
    var spdp = $(elem).data("spdp");
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
            text: 'Anda Yakin Hapus Data Penyidikan ' + srt + '?',
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
                url: BASE_URL + 'Penyidikan/delete_py/',
                type: "POST",
                data: {

                    id: id,
                    smohon: smohon,
                    lap: lap,
                    penetapan: penetapan,
                    spdp: spdp,
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data dihapus',
                        timer: 2000,
                    })
                    $('#tabel-py').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    }
}

function VerifPy(elem) {
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
            url: BASE_URL + 'penyidikan/verif/',
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
                $('#tabel-py').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}

function BukaVerifPy(elem) {
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
                url: BASE_URL + 'penyidikan/buka_verif/',
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
                    $('#tabel-py').DataTable().ajax.reload(null, false);

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

function BukaValidPy(elem) {
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
                url: BASE_URL + 'penyidikan/buka_valid/',
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
                    $('#tabel-py').DataTable().ajax.reload(null, false);
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

$('#tabel-py').on('click', '.verif', function() {
    var id = $(this).data('id');

    $('#id_verif_py').val(id);
});

$('#form-verif-py').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-py")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "penyidikan/valid",
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

                $('#modal-verif-py').modal('hide');
                // TUTUP MODAL
                $('#tabel-py').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});