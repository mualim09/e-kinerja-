<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-layanan-kepegawaian.php";

cek_session();
$user_data = user_data($koneksi);
$breadcrumb = array('PKMJ', 'Mutasi Jabatan', 'Tambah');
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
                    <form role="form" class="form-horizontal" name="FormTambahMutasiJabatan" id="FormTambahMutasiJabatan" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-layanan-kepegawaian.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">OPD</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="konfirmasi" id="konfirmasi" value="<?php echo ($_SESSION['akses'] == '10' ? 'Menunggu Verifikasi' : 'Disetujui') ?>">
<?php
echo component_select_option_where($koneksi, 'opd', 'id', 'nama', 'opd', 'Pilih OPD', '', ($_SESSION['role'] == '1' ? 'id != ""' : 'id = "' . $user_data['opd_id'] . '"'));
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Pegawai</label>
                                <div class="col-sm-10">
<?php
echo component_select_option_where($koneksi, 'pegawai', 'id', 'nama', 'pegawai', 'Pegawai', '', "id = ''");
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">OPD Baru</label>
                                <div class="col-sm-5">
<?php
echo component_select_option($koneksi, 'opd', 'id', 'nama', 'opd_baru', 'Pilih OPD', '');
?>
                                </div>
                                <div class="col-sm-5">
<?php
echo component_select_option_where($koneksi, 'opd_unit_organisasi', 'id', 'nama', 'unit_organisasi_baru', 'Pilih Unit Organisasi', '', 'id = ""');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Jenis Jabatan</label>
                                <div class="col-sm-5">
<?php
echo component_select_option($koneksi, 'ref_jenis_jabatan', 'id', 'label', 'jenis_jabatan', 'Jenis Jabatan', '');
?>
                                </div>
                                <div class="col-sm-5">
<?php
echo component_select_option($koneksi, 'ref_eselon', 'id', 'label', 'eselon', 'Eselon', '');
?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jabatan_baru" class="col-sm-2 control-label">Jabatan Baru</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" name="jabatan_baru" id="jabatan_baru" data-placeholder="Jabatan Baru">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">Pejabat Yang Menetapkan</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="pym" id="pym" placeholder="Pejabat Yang Menetapkan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmt_pns" class="col-sm-2 control-label">TMT</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tmt" name="tmt" placeholder="TMT" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sumber" class="col-sm-2 control-label">SK Jabatan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk_jabatan" name="no_sk_jabatan" placeholder="Nomor" value="" /><br>
                                    <input type="text" class="form-control" id="tgl_sk_jabatan" name="tgl_sk_jabatan" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="file_sk_jabatan" name="file_sk_jabatan" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sk_pelantikan" class="col-sm-2 control-label">SK Pelantikan</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="no_sk_pelantikan" name="no_sk_pelantikan" placeholder="Nomor" value="" /><br>
                                    <input type="text" class="form-control" id="tgl_sk_pelantikan" name="tgl_sk_pelantikan" placeholder="Tanggal" data-date-format="yyyy-mm-dd" value="" />
                                </div>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" id="file_sk_pelantikan" name="file_sk_pelantikan" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pangkat_golongan_ruang" class="col-sm-2 control-label">Sumpah</label>
                                <div class="col-sm-10">
                                    <?php
echo component_select_option($koneksi, 'ref_sumpah_jabatan', 'id', 'label', 'sumpah', 'Sumpah', '');
?>
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolTambahMutasiJabatan" name="TombolTambahMutasiJabatan">Simpan</button>
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