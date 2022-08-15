<?php

use Mpdf\Tag\P;

session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-layanan-kepegawaian.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('Kepangkatan', 'Mutasi Gaji Berkala', 'Tambah');

if(!isset($_GET['usulan-pegawai'])){
    $_GET['usulan-pegawai']  = '';
    $opd_pegawai = '';
}else{
    $opd_pegawai = req_get_where($koneksi,'cv_asn',' id ="'.$_GET['usulan-pegawai'].'"');
    $opd_pegawai = $opd_pegawai['opd_id'];
}
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
                        <h3 class="box-title">Tambah Data</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form role="form" class="form-horizontal" name="FormTambahMutasiGajiBerkala" id="FormTambahMutasiGajiBerkala" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-layanan-kepegawaian.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="konfirmasi" id="konfirmasi" value="<?php echo ($_SESSION['akses'] == '10' ? 'Menunggu Verifikasi' : 'Disetujui') ?>">
<?php
echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'Pilih OPD', $opd_pegawai, ($_SESSION['role'] == '1' ? 'id != ""' : 'id = "' . $user_data['opd_id'] . '"'));
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Pegawai</label>
                                <div class="col-sm-10">
<?php
echo component_select_option_where($koneksi, 'pegawai', 'id', 'nama', 'pegawai', 'Pegawai', $_GET['usulan-pegawai'], "id = '".$_GET['usulan-pegawai']."'");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pejabat_menetapkan" class="col-sm-2 control-label">Pejabat Yang Menetapkan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="pym" name="pym" placeholder="Pejabat Yang Menetapkan" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pns" class="col-sm-2 control-label">Surat Keputusan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk" name="no_sk" placeholder="Nomor" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="tgl_sk" name="tgl_sk" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="icon" class="col-sm-2 control-label">File Surat Keputusan</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file_sk" name="file_sk" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmt_pns" class="col-sm-2 control-label">TMT</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tmt" name="tmt" placeholder="TMT" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_cpns" class="col-sm-2 control-label">Masa Kerja</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="masa_kerja_tahun" name="masa_kerja_tahun" placeholder="Tahun" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="masa_kerja_bulan" name="masa_kerja_bulan" placeholder="Bulan" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kantor_pembayaran" class="col-sm-2 control-label">Kantor Pembayaran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kantor_pembayaran" name="kantor_pembayaran" placeholder="Kantor Pembayaran" value="" />
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahMutasiGajiBerkala" name="TombolTambahMutasiGajiBerkala">Simpan</button>
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
                var BASE_URL = "' . BASE_URL . '";
                var SIMPEG_URL = "' . SIMPEG_URL . '";
                var RESOURCES_URL = "' . RESOURCES_URL . '";
            </script>
         ';
template_js();
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/layanan-kepegawaian/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>