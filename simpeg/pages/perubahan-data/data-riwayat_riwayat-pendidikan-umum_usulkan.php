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
$data = req_get_where($koneksi, 'pegawai_riwayat_pendidikan_umum', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'perubahan-data/data-riwayat/riwayat-pendidikan-umum/');
$breadcrumb = array('Data Riwayat', 'Riwayat Pendidikan Umum', $data['no_sttb'], 'Usulkan');
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
                        <h3 class="box-title">Usulkan Perubahan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormTambahUsulanRiwayatPendidikanUmum" method="post" action="<?php echo SIMPEG_URL;?>controllers/c-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pejabat_menetapkan" class="col-sm-2 control-label">Tingkat Pendidikan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'];?>" readonly />
                                    <input type="hidden" class="form-control" id="pegawai" name="pegawai" placeholder="" value="<?php echo $data['pegawai'];?>" readonly />
                                    <?php
                                        echo component_select_option($koneksi, 'ref_tingkat_pendidikan', 'id', 'label', 'tingkat_pendidikan', 'Tingkat Pendidikan', $data['tingkat_pendidikan']);
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jurusan" class="col-sm-2 control-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" value="<?php echo $data['jurusan'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="institusi" class="col-sm-2 control-label">Institusi</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" placeholder="Nama Institusi" value="<?php echo $data['nama_institusi'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="nama_kepala_institusi" name="nama_kepala_institusi" placeholder="Nama Kepala Institusi" value="<?php echo $data['nama_kepala_institusi'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sttb" class="col-sm-2 control-label">STTB</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sttb" name="no_sttb" placeholder="Nomor" value="<?php echo $data['no_sttb'];?>" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sttb" name="tgl_sttb" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="<?php echo $data['tgl_sttb'];?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">File STTB<sup><i class="fa fa-info-circle" data-toggle="tooltip" title="Biarkan ini kosong jika anda tidak ingin mengubah nya"></i></sup></label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sttb" name="file_sttb" />
                                    <input type="hidden" class="form-control" id="file_sttb_lama" name="file_sttb_lama" value="<?php echo $data['file_sttb']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_kegiatan" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahUsulanRiwayatPendidikanUmum" name="TombolTambahUsulanRiwayatPendidikanUmum">Simpan</button>
                                    <a href="../" class="btn btn-sm btn-default">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
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