$(document).ready(function() {

    $("#modal-tambah-brg-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-tambah-psita-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edit-st-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-brg-psita-p").on('hide.bs.modal', function(e) {
        $('#tabel-brg-psita-p').dataTable().fnClearTable();
        $('#tabel-brg-psita-p').dataTable().fnDestroy();
    });

    $("#modal-tambah-brg-psita-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    $("#modal-verif-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc1-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc2-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc3-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc4-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc5-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc6-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc7-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });
    $("#modal-edoc8-pst-p").on('hide.bs.modal', function(e) {
        $(this).find('form')[0].reset();
    });

    function format(data) {
        // `d` is the original data object for the row
        if (data.updated_at_psita == null) {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_psita + ' Oleh : ' + data.create_by_psita + '</small></td>' +
                '</tr>' +
                '</table> ';
        } else {
            return '<table width="100%" border="0">' +
                '<tr>' +
                '<td><small>Dibuat pada : ' + data.created_at_psita + ' Oleh : ' + data.create_by_psita + 'Diedit pada : ' + data.updated_at_psita + ' Oleh : ' + data.update_by_psita + '</small></td>' +
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
    var table = $('#tabel-psita-p').DataTable({

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
            "url": BASE_URL + "/psita_p/json_psita",
            "dataSrc": "data",
            "dataType": "json",
        },
        "columns": [{
                "data": "urut_psita",
                "orderable": true,

            },
            {
                "className": 'details-control',
                "orderable": false,
                "data": function(data) {
                    if (data.validasi == 0) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_psita + '<br><span class="badge badge-warning">Terdaftar</span></div>'

                    } else if (data.validasi == 1) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_psita +
                            '<br><span class="badge badge-info">Dalam Proses</span>&nbsp<i class="fa fa-lock"></i><br><small> Telah diverifikasi pada : ' + data.verif_date +
                            '<br> Oleh : ' + data.verif_by +
                            '</div>'

                    } else if (data.validasi == 2) {
                        return '<div class="text-left"><i class="fas fa-info-circle"></i> ' + data.no_smohon_psita +
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
                        '<button type="button" class="btn btn-default btn-sm brg" data-toggle="modal" data-target="#modal-brg-psita-p" data-id="' + data.id_psita + '" data-verif="' + data.validasi + '">' + data.count_brg + ' Jenis ' + data.count_jml + ' Item </button>' +
                        '</div>&nbsp</div>'
                }
            },
            {
                "orderable": false,
                "data": function(data) {
                    if (AKSES != 4) {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="edoc1-pst" href="#"  data-toggle="modal" data-target="#modal-edoc1-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                //'<a class="edoc2-pst" href="#"  data-toggle="modal" data-target="#modal-edoc2-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc3-pst" href="#"  data-toggle="modal" data-target="#modal-edoc3-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc4-pst" href="#"  data-toggle="modal" data-target="#modal-edoc4-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc5-pst" href="#"  data-toggle="modal" data-target="#modal-edoc5-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc6-pst" href="#"  data-toggle="modal" data-target="#modal-edoc6-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc7-pst" href="#"  data-toggle="modal" data-target="#modal-edoc7-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                //'<a class="edoc8-pst" href="#"  data-toggle="modal" data-target="#modal-edoc8-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/st/psita_p/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        }
                    } else {
                        if (data.validasi == 0) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="edoc1-pst" href="#"  data-toggle="modal" data-target="#modal-edoc1-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<a class="edoc2-pst" href="#"  data-toggle="modal" data-target="#modal-edoc2-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc3-pst" href="#"  data-toggle="modal" data-target="#modal-edoc3-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc4-pst" href="#"  data-toggle="modal" data-target="#modal-edoc4-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc5-pst" href="#"  data-toggle="modal" data-target="#modal-edoc5-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc6-pst" href="#"  data-toggle="modal" data-target="#modal-edoc6-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc7-pst" href="#"  data-toggle="modal" data-target="#modal-edoc7-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                '<a class="edoc8-pst" href="#"  data-toggle="modal" data-target="#modal-edoc8-pst-p" data-id="' + data.id_psita + '" > [Reupload]</a>' +

                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                '</div>'
                        } else if (data.validasi == 2) {
                            return '<div class="text-left">' +
                                '- Surat Permohonan <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- LP/LI/LM <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" > [Lihat]</i></a>' +
                                '<br>- Penetapan Tersangka<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat SPDP <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Surat Perintah Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Berita Acara Sita<a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Tanda Terima Barang <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" > [Lihat]</a>' +
                                '<br>- Sprindik <a href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" > [Lihat]</a>' +
                                '<br>- <span class="text-success">Produk Penetapan Hukum</span>' +
                                '<a  href="' + BASE_URL + 'file/st/psita_p/' + data.verif_doc + '" target="_blank" > [Lihat]</a>' +
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
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="BukaValidPstP(this)" data-edoc="' + data.verif_doc + '" data-srt="' + data.no_smohon_psita + '" data-id="' + data.id_psita + '" >Batalkan Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onClick="BukaVerifPstP(this)" data-edoc="' + data.verif_doc + '" data-srt="' + data.no_smohon_psita + '" data-id="' + data.id_psita + '" >Batalkan Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm verif" data-toggle="modal" data-target="#modal-verif-pst-p" data-srt="' + data.no_smohon_psita + '" data-id="' + data.id_psita + '" >Validasi</button>' +
                                '</div>' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst-p" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +

                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-success btn-sm" onClick="VerifPstP(this)" data-edoc="' + data.verif_doc + '" data-srt="' + data.no_smohon_psita + '" data-id="' + data.id_psita + '" >Verifikasi</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        }
                    } else if (AKSES == 4) {
                        if (data.validasi == 2) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst-p" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 1) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst-p" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '</div>'
                        } else if (data.validasi == 0) {
                            return '<div class="text-center">' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm detail" data-toggle="modal" data-target="#modal-detail-pst-p" data-id="' + data.id_psita + '">Lihat</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-default btn-sm edit" data-toggle="modal" data-target="#modal-edit-pst-p" data-id="' + data.id_psita + '">Edit</button>' +
                                '</div>&nbsp;' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-danger btn-sm" onClick="HapusPstP(this)" data-srt="' + data.no_smohon_sita + '"  data-id="' + data.id_psita + '" data-smohon="' + data.edoc_smohon_sita + '" data-lap="' + data.edoc_lap_pol_intel + '" data-penetapan="' + data.edoc_penetapan + '" data-sp="' + data.edoc_sp + '" data-valid="' + data.validasi + '">Hapus</button>' +
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

    $('#tabel-psita-p tbody').on('click', 'td.details-control', function() {
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

    $('#filter-table-pst').on('change', function() {
        table.search(this.value).draw();
    });
});

//klik get id untuk tbl barang
$('#tabel-psita-p').on('click', '.brg', function() {
    var id = $(this).data('id');
    var verif = $(this).data('verif');
    if (verif == 0) {
        document.getElementById('tambah-brg-psita-p').innerHTML = '<div class="btn-group">' +
            '<button type="button" id="tambah-brg-psita-p" data-id="' + id + '" class="btn btn-block btn-outline-primary brg" data-toggle="modal" data-target="#modal-tambah-brg-psita-p">+ Barang</button>' +
            '</div>';

    } else if (verif == 1) {
        document.getElementById('tambah-brg-psita-p').innerHTML = '';
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
    var table = $('#tabel-brg-psita-p').DataTable({
        destroy: true,
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
            "url": BASE_URL + "/psita_p/json_brg_psita/" + id,
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
                        '<button type="button" class="btn btn-default btn-sm" onClick="HapusBrgPstP(this)" data-srt="' + data.nm_brg + '"  data-id="' + data.id_brg_psita + '" >Hapus</button>' +
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
$('#form-tambah-pst-p').on('submit', function(e) {
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
    var postData = new FormData($("#form-tambah-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/tambah_pst",
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

                $('#modal-tambah-psita-p').modal('hide');
                $('#disclaimerPstP').prop('checked', false); // Unchecks it
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});
//get data edit
$('#tabel-psita-p').on('click', '.edit', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'psita_p/get_id_psita/' + id,
        dataType: "JSON",
        async: true,

        success: function(data) {
            $('#id_psita_edit').val(data['id_psita']);
            $('#validasi_pst').val(data['validasi']);
            $('#no_smohon_psita_edit').val(data['no_smohon_psita']);
            $('#unit_pst_edit').val(data['id_unit']);
        }
    });

});

//edit sita
$('#form-edit-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edit-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/edit_pst",
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


            $('#modal-edit-pst-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-psita-p').DataTable().ajax.reload(null, false);
        },
        error: function(data) {

            swal({
                    type: 'warning',
                    title: 'Update',
                    text: 'Gagal Simpan Data',
                    timer: 2000,
                })
                // BERSIHKAN FORM MODAL


            $('#modal-edit-pst').modal('hide');
            // TUTUP MODAL
            $('#tabel-psita').DataTable().ajax.reload(null, false);
        },

    })
    return false;
});

//tambah barang
$('#tambah-brg-psita-p').on('click', '.brg', function() {
    var id = $(this).data('id');
    $('#id_psita').val(id);
});
//tambah barang aksi
$('#form-tambah-brg-psita-p').on('submit', function(e) {

    var postData = new FormData($("#form-tambah-brg-psita-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/tambah_brg_pst",
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


            $('#modal-tambah-brg-psita-p').modal('hide');
            // TUTUP MODAL
            $('#tabel-brg-psita-p').DataTable().ajax.reload(null, false);
            $('#tabel-psita-p').DataTable().ajax.reload(null, false);
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
$('#tabel-psita-p').on('click', '.detail', function() {
    var id = $(this).data('id');
    $.ajax({
        type: "POST",
        "url": BASE_URL + 'psita_p/get_id_psita/' + id,
        dataType: "JSON",
        async: true,
        success: function(data) {
            document.getElementById('d1').innerHTML = data.no_smohon_psita;
            document.getElementById('d2').innerHTML = data.nm_unit;
            document.getElementById('d3').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_smohon + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d4').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_lap_pol_intel + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d5').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_penetapan + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d6').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_spdp + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d7').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_p_sita + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d8').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ba + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d9').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_ttbs + '" target="_blank" ><i class="fa fa-file"></i></a>';
            document.getElementById('d10').innerHTML = '<a class="btn btn-info btn-sm" href="' + BASE_URL + 'file/st/psita_p/' + data.edoc_sprindik + '" target="_blank" ><i class="fa fa-file"></i></a>';
        }
    });

});



//REUPLOAD SMOHON
$('#tabel-psita-p').on('click', '.edoc1-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc1').val(id);

});

$('#form-edoc1-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc1-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_smohon",
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

                $('#modal-edoc1-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

//REUPLOAD LAPPOLINTEL
$('#tabel-psita-p').on('click', '.edoc2-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc2').val(id);
});

$('#form-edoc2-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc2-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_lap_pol_intel",
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

                $('#modal-edoc2-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

//REUPLOAD LAPPOLINTEL
$('#tabel-psita-p').on('click', '.edoc3-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc3').val(id);
});

$('#form-edoc3-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc3-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_penetapan",
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

                $('#modal-edoc3-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-psita-p').on('click', '.edoc4-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc4').val(id);
});

$('#form-edoc4-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc4-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_spdp",
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

                $('#modal-edoc4-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-psita-p').on('click', '.edoc5-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc5').val(id);
});

$('#form-edoc5-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc5-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_sp",
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

                $('#modal-edoc5-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-psita-p').on('click', '.edoc6-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc6').val(id);
});

$('#form-edoc6-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc6-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_ba",
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

                $('#modal-edoc6-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-psita-p').on('click', '.edoc7-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc7').val(id);
});

$('#form-edoc7-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc7-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_ttbs",
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

                $('#modal-edoc7-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

$('#tabel-psita-p').on('click', '.edoc8-pst', function() {
    var id = $(this).data('id');
    $('#id_edoc8').val(id);
});

$('#form-edoc8-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-edoc8-pst-p")[0]);
    //var postData = new FormData($("#form-tambah-smohongd")[1]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/reupload_sprindik",
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

                $('#modal-edoc8-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function HapusPstP(elem) {
    var id = $(elem).data("id");
    var srt = $(elem).data("srt");
    var smohon = $(elem).data("smohon");
    var lap = $(elem).data("lap");
    var penetapan = $(elem).data("penetapan");
    var sp = $(elem).data("sp");
    var ba = $(elem).data("ba");
    var ttba = $(elem).data("ttba");
    var sprindik = $(elem).data("sprindik");
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
            text: 'Anda Yakin Hapus Data Persetujuan Sita ' + srt + '?',
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
                url: BASE_URL + 'psita_p/delete_pst/',
                type: "POST",
                data: {

                    id: id,
                    smohon: smohon,
                    lap: lap,
                    penetapan: penetapan,
                    sp: sp,
                    ba: ba,
                    ttba: ttba,
                    sprindik: sprindik
                },
                success: function() {
                    swal({
                        type: 'success',
                        title: 'Berhasil',
                        text: 'Data dihapus',
                        timer: 2000,
                    })
                    $('#tabel-psita-p').DataTable().ajax.reload(null, false);
                },
                error: function(xhr, ajaxOptions, thrownError) {

                    swal({
                        type: 'warning',
                        title: 'Berhasil',
                        text: 'Data dihapus',
                        timer: 2000,
                    })
                    $('#tabel-psita-p').DataTable().ajax.reload(null, false);
                }
            });
        });
    }
}



function BukaVerifPstP(elem) {
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
                url: BASE_URL + 'psita_p/buka_verif/',
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
                    $('#tabel-psita-p').DataTable().ajax.reload(null, false);
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

function BukaValidPstP(elem) {
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
                url: BASE_URL + 'psita_p/buka_valid/',
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
                    $('#tabel-psita-p').DataTable().ajax.reload(null, false);
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

function HapusBrgPstP(elem) {
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
            url: BASE_URL + 'psita_p/delete_brg_pst/',
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
                $('#tabel-brg-psita-p').DataTable().ajax.reload(null, false);
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);

            },
            error: function(xhr, ajaxOptions, thrownError) {


            }
        });
    });
}

$('#tabel-psita-p').on('click', '.verif', function() {
    var id = $(this).data('id');
    $('#id_verif_pst_p').val(id);
});

$('#form-verif-pst-p').on('submit', function(e) {
    e.preventDefault();
    var postData = new FormData($("#form-verif-pst-p")[0]);
    $.ajax({
        type: "post",
        "url": BASE_URL + "psita_p/valid",
        processData: false,
        contentType: false,
        data: postData,
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

                $('#modal-verif-pst-p').modal('hide');
                // TUTUP MODAL
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            }
        },
    })
    return false;
});

function VerifPstP(elem) {
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
            url: BASE_URL + 'psita_p/verif/',
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
                $('#tabel-psita-p').DataTable().ajax.reload(null, false);
            },
            error: function(xhr, ajaxOptions, thrownError) {}
        });
    });
}