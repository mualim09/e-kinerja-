<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-akun.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('Pegawai');
?>
<!DOCTYPE html>
<html>

<head>
    <?php
template_title(page_title(), BASE_TITLE);
template_favicon();
template_meta();
template_css('base');
?>
</head>

<body class="hold-transition skin-custom sidebar-mini">
    <div class="se-pre-con"></div>
    <div class="wrapper">
        <?php
template_header_ekinerja();
template_navigasi_ekinerja(page_title(), $koneksi, $user_data);
?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php template_page_header($koneksi, page_id());?>
                </h1>
                <ol class="breadcrumb">
                    <?php template_breadcrumb($koneksi, page_id(), $breadcrumb);?>
                </ol>
            </section>

            <section class="content">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daftar Akun User</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="daftar_data_1" style="width: 100%;" class="table table-bordered table-fix-last">
                            <thead>
                                <tr class="bg-custom">
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Status Kepegawaian</th>
                                    <th>OPD</th>
                                    <th>Unit Organisasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <?php
template_footer(BASE_TITLE);
?>
    </div>
    <?php
echo '
            <script>
				var role="' . $_SESSION['role'] . '";
                var user_opd="' . $user_data['opd'] . '";
                var BASE_URL = "' . BASE_URL . '";
                var EKINERJA_URL =  "' . BASE_URL . 'ekinerja/";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/ekinerja/akun/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>