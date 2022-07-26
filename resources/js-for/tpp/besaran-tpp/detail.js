$(document).ready(function () {
    $('#daftar_data_1 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    var table1 = $('#daftar_data_1').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/tpp/besaran-tpp/tugas-tambahan_data.php?nama_jabatan=" + nama_jabatan,
        lengthMenu: [
            [5, 10, 25, 100, -1],
            [5, 10, 25, 100, "All"]
        ],
        pageLength: 10,
        dom: '<"columns row"<"column col-sm-6"l><"column col-sm-6 text-right"B>>,' +
            '<"columns row"<"column col-sm-12"tr>>,' +
            '<"columns row"<"column col-sm-12 text-center"i>>,' +
            '<"columns row"<"column col-sm-12"<"text-center"p>>>',
        buttons: [{
            className: 'btn btn-sm btn-primary ',
            text: 'Tambah Data',
            action: function (e, dt, node, config) {
                document.location.href = TPP_URL + 'besaran-tpp/' + nama_jabatan + '/tugas-tambahan/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    table1.columns().every(function () {
        var table = this;
        $('input', this.header()).on('keyup change', function () {
            if (table.search() !== this.value) {
                table.search(this.value).draw();
            }
        });
        $('select', this.header()).on('change', function () {
            if (table.search() !== this.value) {
                table.search(this.value).draw();
            }
        });
    });

    $(document).on('click', 'TombolHapus', function () {
        var req = "Modal Konfirmasi";
        var judul = $(this).attr("judul");
        var form = $(this).attr("formreq");
        var pertanyaan = $(this).attr("pertanyaan");
        var parameter = $(this).attr("parameter");
        var data = $(this).attr("value");
        $.ajax({
            type: "post",
            url: TPP_URL + "controllers/c-besaran-tpp.php",
            data: {
                req: req,
                judul: judul,
                form: form,
                pertanyaan: pertanyaan,
                parameter: parameter,
                data: data
            },
            cache: false,
            success: function (msg) {
                $("#modal").html(msg);
                $("#modal").modal("show");
            }
        });
    });
});