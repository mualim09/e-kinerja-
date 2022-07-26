$(document).ready(function () {
    $('#daftar_data_l1 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    $('#daftar_data_r1 thead th').each(function () {
        var title = $(this).text();

        if (title !== '') {
            $(this).html(title + '<br><input type="text" style="width: 100%" class="form-control column_search" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    var table1 = $('#daftar_data_l1').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/opd/unit-organisasi_data.php?opd=" + opd,
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
                document.location.href = SIMPEG_URL + 'opd/' + opd + '/unit-organisasi/tambah/';
            },
            init: function (api, node, config) {
                $(node).removeClass('btn-default')
            }
        }],
    });

    var table2 = $('#daftar_data_r1').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "ajax": RESOURCES_URL + "tabel/simpeg/opd/struktur-organisasi_data.php?opd=" + opd,
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
                document.location.href = SIMPEG_URL + 'opd/' + opd + '/struktur-organisasi/tambah/';
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

    table2.columns().every(function () {
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
            url: SIMPEG_URL + "controllers/c-opd.php",
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