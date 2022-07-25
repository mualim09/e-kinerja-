<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-perubahan-data.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pendidikan-umum/');
$data = req_get_where($koneksi, 'v_u_pegawai_riwayat_pendidikan_umum ', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pendidikan-umum/');
$breadcrumb = array('Data Riwayat', 'Riwayat Pendidikan Umum', 'Usulan', $data['no_sttb']);
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    template_title(page_title(), BASE_TITLE);
    template_favicon();
    template_meta();
    template_css('app');
    ?>
</head>

<body class="hold-transition skin-custom sidebar-mini">
    <div class="se-pre-con"></div>
    <div class="wrapper">
        <?php
        template_header($user_data, $koneksi, SIMPEG_TITLE);
        template_navigasi(page_title(), $koneksi, 'simpeg', SIMPEG_URL);
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php
                    template_page_header($koneksi, portal_id());
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <?php
                    template_breadcrumb($koneksi, portal_id(), $breadcrumb);
                    ?>
                </ol>
            </section>

            <section class="content">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usulan Perubahan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:25%">NIP</th>
                                    <td><?php echo $data['pegawai_nip'];?></td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td><?php echo $data['pegawai_nama'];?></td>
                                </tr>
                                <tr>
                                    <th>Tingkat Pendidikan</th>
                                    <td><?php echo $data['tingkat_pendidikan'];?></td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td><?php echo $data['jurusan'];?></td>
                                </tr>
                                <tr>
                                    <th>Institusi</th>
                                    <td>
                                        <i>Nama Institusi:</i> <?php echo $data['nama_institusi'];?><br>
                                        <i>Nama Kepala Institusi:</i> <?php echo $data['nama_kepala_institusi'];?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>STTB</th>
                                    <td>
                                        <i>Nomor:</i> <?php echo $data['no_sttb'];?><br>
                                        <i>Tanggal:</i> <?php echo content_tgl_indo($data['tgl_sttb']);?>    
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <th style="width:25%">Status</th>
                                    <td><?php echo $data['status'];?></td>
                                </tr>
                                <tr>
                                    <th>Waktu Kirim</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data['ts'])[0]).', '.explode(' ', $data['ts'])[1];?></td>
                                </tr>
                                <tr <?php echo ($data['status'] == 'Dikirim' ? 'style="display: none;"' : '');?>>
                                    <th>Waktu Terima</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data['tr'])[0]).', '.explode(' ', $data['tr'])[1];?></td>
                                </tr>
                                <tr <?php echo ($data['status'] == 'Ditolak' ? '' : 'style="display: none;"');?>>
                                    <th>Alasan</th>
                                    <td><?php echo $data['alasan'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php
        template_footer(SIMPEG_TITLE);
        ?>
    </div>
    <?php
    echo '
            <script>
                var role="' . $_SESSION['role'] . '";
                var user_opd="' . $user_data['opd'] . '";
                var BASE_URL = "'.BASE_URL.'";
                var SIMPEG_URL = "'.SIMPEG_URL.'";
                var RESOURCES_URL = "'.RESOURCES_URL.'";
            </script>
         ';
    template_js();
    echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/perubahan-data/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
    ?>
</body>

</html>