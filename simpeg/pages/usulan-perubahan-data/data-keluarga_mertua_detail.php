<?php
session_start();
require "../../../app/config.php";
require "../../../app/models.php";
require "../../../app/component.php";
require "../../../app/autentikasi.php";
require "../../../app/template.php";
require "../../controllers/c-usulan-perubahan-data.php";

cek_session();
$user_data = user_data($koneksi);
check_page_request($_GET['key1'], SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/mertua/');
check_status($koneksi, 'usulan_pegawai_mertua', $_GET['key1']);
$data = req_get_where($koneksi, 'v_pegawai_mertua', 'id = "' . $_GET['key1'] . '"');
$data_alamat = req_get_where($koneksi, 'v_pegawai_mertua_alamat', 'id = "' . $_GET['key1'] . '"');
$data_u = req_get_where($koneksi, 'v_u_pegawai_mertua', 'id = "' . $_GET['key1'] . '"');
$data_alamat_u = req_get_where($koneksi, 'v_u_pegawai_mertua_alamat', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'usulan-perubahan-data/data-keluarga/mertua/');
$breadcrumb = array('Data Keluarga', 'Orang Tua', 'Usulan', $data['pegawai_nama']);
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data Saat Ini</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <p class="lead">Data Ayah</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data['nama_a']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data['tempat_lahir_a']; ?>,
                                                <?php echo content_tgl_indo($data['tgl_lahir_a']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data['pekerjaan_a']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>
                                                <?php echo $data_alamat['alamat_a']; ?><br>
                                                <?php echo ($data_alamat['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_alamat['rt_a'])) . '' : ''); ?>
                                                <?php echo ($data_alamat['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_alamat['rw_a'])) . '' : ''); ?><br>
                                                <?php echo ($data_alamat['keldes_a'] != '' ? '' . ucwords(strtolower($data_alamat['keldes_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_alamat['kecamatan_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kabkot_a'] != '' ? '' . ucwords(strtolower($data_alamat['kabkot_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['provinsi_a'] != '' ? '' . ucwords(strtolower($data_alamat['provinsi_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_alamat['kode_pos_a'])) . '<br>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <p class="lead">Data Ibu</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data['nama_i']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data['tempat_lahir_i']; ?>,
                                                <?php echo content_tgl_indo($data['tgl_lahir_i']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data['pekerjaan_i']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>
                                                <?php echo $data_alamat['alamat_i']; ?><br>
                                                <?php echo ($data_alamat['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_alamat['rt_i'])) . '' : ''); ?>
                                                <?php echo ($data_alamat['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_alamat['rw_i'])) . '' : ''); ?><br>
                                                <?php echo ($data_alamat['keldes_i'] != '' ? '' . ucwords(strtolower($data_alamat['keldes_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_alamat['kecamatan_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kabkot_i'] != '' ? '' . ucwords(strtolower($data_alamat['kabkot_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['provinsi_i'] != '' ? '' . ucwords(strtolower($data_alamat['provinsi_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_alamat['kode_pos_i'])) . '<br>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Usulan Perubahan</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <p class="lead">Data Ayah</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data_u['nama_a']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data_u['tempat_lahir_a']; ?>,
                                                <?php echo content_tgl_indo($data_u['tgl_lahir_a']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data_u['pekerjaan_a']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>
                                                <?php echo $data_alamat_u['alamat_a']; ?><br>
                                                <?php echo ($data_alamat_u['rt_a'] != '' ? 'RT ' . ucwords(strtolower($data_alamat_u['rt_a'])) . '' : ''); ?>
                                                <?php echo ($data_alamat_u['rw_a'] != '' ? 'RW ' . ucwords(strtolower($data_alamat_u['rw_a'])) . '' : ''); ?><br>
                                                <?php echo ($data_alamat_u['keldes_a'] != '' ? '' . ucwords(strtolower($data_alamat_u['keldes_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kecamatan_a'] != '' ? '' . ucwords(strtolower($data_alamat_u['kecamatan_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kabkot_a'] != '' ? '' . ucwords(strtolower($data_alamat_u['kabkot_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['provinsi_a'] != '' ? '' . ucwords(strtolower($data_alamat_u['provinsi_a'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kode_pos_a'] != '' ? '' . ucwords(strtolower($data_alamat_u['kode_pos_a'])) . '<br>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <p class="lead">Data Ibu</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:25%">Nama</th>
                                            <td><?php echo $data_u['nama_i']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tempat Tanggal Lahir</th>
                                            <td>
                                                <?php echo $data_u['tempat_lahir_i']; ?>,
                                                <?php echo content_tgl_indo($data_u['tgl_lahir_i']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pekerjaan</th>
                                            <td><?php echo $data_u['pekerjaan_i']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>
                                                <?php echo $data_alamat_u['alamat_i']; ?><br>
                                                <?php echo ($data_alamat_u['rt_i'] != '' ? 'RT ' . ucwords(strtolower($data_alamat_u['rt_i'])) . '' : ''); ?>
                                                <?php echo ($data_alamat_u['rw_i'] != '' ? 'RW ' . ucwords(strtolower($data_alamat_u['rw_i'])) . '' : ''); ?><br>
                                                <?php echo ($data_alamat_u['keldes_i'] != '' ? '' . ucwords(strtolower($data_alamat_u['keldes_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kecamatan_i'] != '' ? '' . ucwords(strtolower($data_alamat_u['kecamatan_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kabkot_i'] != '' ? '' . ucwords(strtolower($data_alamat_u['kabkot_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['provinsi_i'] != '' ? '' . ucwords(strtolower($data_alamat_u['provinsi_i'])) . '<br>' : ''); ?>
                                                <?php echo ($data_alamat_u['kode_pos_i'] != '' ? '' . ucwords(strtolower($data_alamat_u['kode_pos_i'])) . '<br>' : ''); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Catatan Usulan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:20%">Status</th>
                                    <td><?php echo $data_u['status']; ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu Kirim</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data_u['ts'])[0]) . ', ' . explode(' ', $data_u['ts'])[1]; ?></td>
                                </tr>
                                <tr <?php echo ($data_u['status'] == 'Dikirim' ? 'style="display: none;"' : ''); ?>>
                                    <th>Waktu Terima</th>
                                    <td><?php echo content_tgl_indo(explode(' ', $data_u['tr'])[0]) . ', ' . explode(' ', $data_u['tr'])[1]; ?></td>
                                </tr>
                                <tr <?php echo ($data_u['status'] == 'Ditolak' ? '' : 'style="display: none;"'); ?>>
                                    <th>Alasan</th>
                                    <td><?php echo $data_u['alasan']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box box-blue" <?Php echo ($data_u['status'] == 'Ditolak' ? 'style="display:none;"' : '') ?>>
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Verifikasi</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormVerifikasiMertua" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-usulan-perubahan-data.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="persetujuan_paraf" class="col-sm-2 control-label">Tindakan</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?php echo $data['id'] ?>" readonly />
                                    <select class="select2 form-control" name="tindakan" id="tindakan" data-placeholder="Tindakan">
                                        <option></option>
                                        <option value="Setuju">Setuju</option>
                                        <option value="Tidak Setuju">Tidak Setuju</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group container_alasan" style="display: none;">
                                <label for="alasan" class="col-sm-2 control-label">Alasan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alasan" name="alasan"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="check_form" id="check_form" value="y" class="flat-red" /> <i>Saya sudah mengisi data semua data dengan benar</i>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolVerifikasiMertua" name="TombolVerifikasiMertua">Simpan</button>
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
echo '<script src="' . RESOURCES_URL . 'js-for/simpeg/usulan-perubahan-data/' . basename($_SERVER['PHP_SELF'], '.php') . '.js"></script>';
?>
</body>

</html>