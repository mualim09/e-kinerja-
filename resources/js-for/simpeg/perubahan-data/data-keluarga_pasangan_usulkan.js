

$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
})
$('#tgl_lahir').datepicker({
    autoclose: true,
    language: 'id'
});
$('#tgl_buku_nikah').datepicker({
    autoclose: true,
    language: 'id'
});
$(document).ready(function () {
    $(".select2").select2();
    $('#FormTambahUsulanPasangan').bootstrapValidator({
        live: 'disabled',
        message: 'This value is not valid',
        fields: {
            check_form: {
                validators: {
                    notEmpty: {
                        message: 'Centang bagian ini jika anda sudah mengisi form dengan benar'
                    }
                }
            },
        }
    });
});