//Warning Message
function SaProses() {
    swal({
        title: "Mohon Maaf",
        text: "Halaman dalam pengembangan",
        type: "warning",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OKE",
        closeOnConfirm: false
    });
};

! function(window, document, $) {
    "use strict";
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
        checkboxClass: "icheckbox_square-green",
        radioClass: "iradio_square-green"
    }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
}(window, document, jQuery);

function Sukses() {
    swal({
        title: "Berhasil",
        text: "Data disimpan",
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "OKE",
        closeOnConfirm: false
    });
}

function Verify() {
    swal({
        type: 'warning',
        title: 'Tidak diijinkan ',
        text: 'Data telah diverifikasi',
        timer: 3000,
    })
}