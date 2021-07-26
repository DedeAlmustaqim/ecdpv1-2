$(document).ready(function() {

    /* Formatting function for row details - modify as you need */
    //clear data modal
    $("#modal-tambah-brg-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-tambah-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edit-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-verif-sita").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-brg-ijinsita-p").on('hide.bs.modal', function(e) {
        $('#tabel-brg-sita-p').dataTable().fnClearTable();
        $('#tabel-brg-sita-p').dataTable().fnDestroy();

    });

    $("#modal-reupload-smohon-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-lappolintel-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-penetapan-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-reupload-sp-st-p").on('hide.bs.modal', function(e) {
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
    var table = $('#tabel-ijinsita-p').DataTable({
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
            "url": BASE_URL + "/ijinsita_p/json",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "urut_sita",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_sita + '<br><span class="badge badge-warning ">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_sita +
                            '<br><span class="badge badge-info ">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by +
                            '</div>'
                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_sita +
                            '<br><span class="badge badge-success ">Selesai</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
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
                    return '<div class="text-center"><div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-sm brg" data-toggle="modal" data-target="#modal-brg-ijinsita-p" data-id="' + data.id_ijin_sita + '" data-verif="' + data.validasi + '">' + data.count_brg + ' Jenis ' + data.count_jml + ' Item </button>' +
                        '</div>&nbsp</div>'
                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-reupload-smohon-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-reupload-lappolintel-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-penetapan" href="#"  data-toggle="modal" data-target="#modal-reupload-penetapan-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- SPRINT Sidik <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sidik + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-sprints" href="#"  data-toggle="modal" data-target="#modal-reupload-sprints-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- SPRINT Sita <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sita + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-sprintst" href="#"  data-toggle="modal" data-target="#modal-reupload-sprintst-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="reupload-sp" href="#"  data-toggle="modal" data-target="#modal-reupload-sp-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/st/ijinsita_p/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="reupload-s-mohon" href="#"  data-toggle="modal" data-target="#modal-reupload-smohon-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="reupload-lap-pol-intel" href="#"  data-toggle="modal" data-target="#modal-reupload-lappolintel-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-penetapan" href="#"  data-toggle="modal" data-target="#modal-reupload-penetapan-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- SPRINT Sidik <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sidik + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-sprints" href="#"  data-toggle="modal" data-target="#modal-reupload-sprints-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +
                                '<br>- SPRINT Sita <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sita + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-sprintst" href="#"  data-toggle="modal" data-target="#modal-reupload-sprintst-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +

                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                '<a class="reupload-sp" href="#"  data-toggle="modal" data-target="#modal-reupload-sp-st-p" data-id="' + data.id_ijin_sita + '" > [Reupload]</a>' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT Sidik <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sidik + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT Sita <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sita + '" target="_blank" > [Lihat]</a>' +

                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT Sidik <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sidik + '" target="_blank" > [Lihat]</a>' +
                                '<br>- SPRINT Sita <a href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sita + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/st/ijinsita_p/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
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
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="BukaValidStP(this)" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" data-edoc="' + data.verif_doc + '" >Batalkan Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerifStP(this)" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" data-edoc="' + data.verif_doc + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-sita-p" data-srt="' + data.no_smohon_sita + '" data-id="' + data.id_ijin_sita + '" >Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" onClick="VerifSitaP(this)"  data-id="' + data.id_ijin_sita + '"  data-srt="' + data.no_smohon_sita + '" >Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    } else if (AKSES == 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-st-p" data-id="' + data.id_ijin_sita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-st-p" data-id="' + data.id_ijin_sita + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="HapusStP(this)" data-srt="' + data.no_smohon_sita + '"  data-id="' + data.id_ijin_sita + '" data-smohon="' + data.edoc_smohon_sita + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan + '" data-sp="' + data.edoc_sp + '" data-valid="' + data.validasi + '">Hapus</button>' +
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
    $('#tabel-ijinsita-p tbody').on('click', 'td.details-control', function() {
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
    $('#filter-table-st').on('change', function() {
        table.search(this.value).draw();
    });
});

//klik get id untuk tbl barang
$('#tabel-ijinsita-p').on('click', '.brg', function() {
    var id = $(this).data('id');
    var verif = $(this).data('verif');
    if (AKSES == 4) {
        if (verif == 0) {
            document.getElementById('tambah-brg-p').innerHTML = '<div class="btn-group">' +
                '<button type="button" id="tambah-brg-p" data-id="' + id + '" class="btn btn-block btn-outline-primary brg" data-toggle="modal" data-target="#modal-tambah-brg-p">+ Barang</button>' +
                '</div>';

        } else if (verif == 1) {
            document.getElementById('tambah-brg-p').innerHTML = '';
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
    var table = $('#tabel-brg-sita-p').DataTable({
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
            "url": BASE_URL + "/ijinsita_p/json_brg_sita/" + id,
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [

            {
                "data": "urut_brg",
                "orderable": true,

            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.nm_brg + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.jml + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.lokasi_sita + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.plk_sita + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.pemilik + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="text-left">' + data.ket + '</div>'

                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    return '<div class="btn-group">' +
                        '<button type="button" class="btn btn-default btn-sm" onClick="HapusBrgP(this)" data-srt="' + data.nm_brg + '"  data-id="' + data.id_brg_ijin_sita + '" >Hapus</button>' +
                        '</div>&nbsp;'
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

});
//tambah sita
$('#form-tambah-st-p').on('submit', function(e) {
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
    var postData = new FormData($("#form-tambah-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/tambah_st",
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

                $('#modal-tambah-st-p').modal('hide');
                $('#disclaimerSt-p').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
//get data edit
$('#tabel-ijinsita-p').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'ijinsita_p/get_id_ijin_sita/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            $('#id_ijin_sita_edit_p').val(data['id_ijin_sita']);
            $('#validasi_st_p').val(data['validasi']);
            $('#no_smohon_sita_edit_p').val(data['no_smohon_sita']);
            $('#unit_st_edit_p').val(data['id_unit']);
        }
    });

});

//edit sita
$('#form-edit-st-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/edit_st",
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


            $('#modal-edit-st-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
        },
        error: function(data) {

            swal({
                    type: 'warning',
                    title: 'Update',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-st-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

//tambah barang
$('#tambah-brg-p').on('click', '.brg', function() {
    var id = $(this).data('id');
    $('#id_ijin_sita').val(id);
});
//tambah barang aksi
$('#form-tambah-brg-p').on('submit', function(e) {

    var postData = new FormData($("#form-tambah-brg-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/tambah_brg",
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


            $('#modal-tambah-brg-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-brg-sita-p').DataTable().ajax.reload(null, false);
            $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
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
$('#tabel-ijinsita-p').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'ijinsita_p/get_id_ijin_sita/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_sita;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_smohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d4').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d5').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sidik + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d5b').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sprint_sita + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d6').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/ijinsita_p/' + data.edoc_sp + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });

});



//REUPLOAD SMOHON
$('#tabel-ijinsita-p').on('click', '.reupload-s-mohon', function() {
    var id = $(this).data('id');
    $('#id_edoc1').val(id);

});
//REUPLOAD LAPPOLINTEL
$('#tabel-ijinsita-p').on('click', '.reupload-lap-pol-intel', function() {
    var id = $(this).data('id');
    $('#id_edoc2').val(id);
});

//REUPLOAD LAPPOLINTEL
$('#tabel-ijinsita-p').on('click', '.reupload-penetapan', function() {
    var id = $(this).data('id');
    $('#id_edoc3').val(id);
});

$('#tabel-ijinsita-p').on('click', '.reupload-sp', function() {
    var id = $(this).data('id');
    $('#id_edoc4').val(id);
});

$('#form-edoc1-st-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/reupload_smohon",
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

                $('#modal-reupload-smohon-st-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#form-edoc2-st-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/reupload_lap_pol_intel",
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

                $('#modal-reupload-lappolintel-st-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc3-st-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc3-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/reupload_penetapan",
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

                $('#modal-reupload-penetapan-st-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
$('#form-edoc4-st-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc4-st-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/reupload_sp",
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

                $('#modal-reupload-sp-st-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function HapusStP(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");
    var penetapan = $(elem).data("penetapan");
    var sp = $(elem).data("sp");
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
            text: 'Anda Yakin Hapus Data Ijin Sita ' + srt + '?',
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
                url: BASE_URL + 'ijinsita_p/delete_st/',
                type: "POST",
                data: {

                    id: id,
                    smohon: smohon,
                    lap: lap,
                    penetapan: penetapan,
                    sp: sp,
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data dihapus',
                        timer: 2000,
                    })
                    $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {


                }
            });
        });
    }
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
        }, function(isConfirm) {
            if (!isConfirm) return;
            $.ajax({
                url: BASE_URL + 'ijinsita/valid/',
                type: "POST",
                data: {

                    id: id,
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data diverifikasi',
                        timer: 2000,
                    })
                    $('#tabel-ijinsita').DataTable().ajax.reload(null, false);
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

function BukaVerifStP(elem) {
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
                url: BASE_URL + 'ijinsita_p/buka_verif/',
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
                    $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
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

function BukaValidStP(elem) {
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
                url: BASE_URL + 'ijinsita_p/buka_valid/',
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
                    $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
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


function HapusBrgP(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");


    swal({
        title: 'Hapus',
        text: 'Anda Yakin Hapus  ' + srt + '?',
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
            url: BASE_URL + 'ijinsita_p/delete_brg/',
            type: "POST",
            data: {

                id: id,
            },
            success: function() {
                swal({
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Data dihapus',
                    timer: 2000,
                })
                $('#tabel-brg-sita-p').DataTable().ajax.reload(null, false);
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}

$('#tabel-ijinsita-p').on('click', '.verif', function() {
    var id = $(this).data('id');

    $('#id_verif_sita_p').val(id);
});

$('#form-verif-sita-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-sita-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "ijinsita_p/valid",
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

                $('#modal-verif-sita-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function VerifSitaP(elem) {
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
            url: BASE_URL + 'ijinsita_p/verif/',
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
                $('#tabel-ijinsita-p').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}