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
check_page_request($_GET['key1'], SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/');
($_SESSION['role'] == '1' ? check_status($koneksi, 'simpeg_lp_mutasi_pgr', $_GET['key1']) : '');
$data = req_get_where($koneksi, 'v_simpeg_lp_mutasi_pgr', 'id = "' . $_GET['key1'] . '"');
check_page_request($data['id'], SIMPEG_URL . 'layanan-kepegawaian/kepangkatan/mutasi-kepangkatan/');
$breadcrumb = array('Kepangkatan', 'Mutasi Kepangkatan', $data['no_sk']);
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
                    <div class="col-sm-8">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Detail Data</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:25%">Pejabat Yang Menetapkan</th>
                                        <td><?php echo $data['pym']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>SK</th>
                                        <td>
                                            <i>Nomor:</i> <?php echo $data['no_sk']; ?><br>
                                            <i>Tanggal:</i> <?php echo content_tgl_indo($data['tgl_sk']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pangkat Golongan Ruang</th>
                                        <td><?php echo $data['pgr']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>TMT</th>
                                        <td><?php echo content_tgl_indo($data['tmt']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="box-footer">
                                <a <?Php echo ($data['status'] == 'Disetujui' ? 'style="display:none;"' : '') ?> href="sunting/" class="btn btn-sm btn-success">Sunting</a>
                                <TombolHapus judul="Hapus Mutasi Jabatan" formreq="HapusMutasiKepangkatan" pertanyaan="Anda yakin ingin menghapus data mutasi ini?<br>Menghapus data akan mengembalikan data sebelumnya, jika status data sudah <b>Disetujui</b>." parameter="id" value="<?php echo $data['id'] ?>" class="btn btn-sm btn-danger">Hapus</TombolHapus>
                                <a href="../" class="btn btn-sm btn-default">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Data Pegawai</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:30%">NIP</th>
                                            <td><?php echo $data['pegawai_nip']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Nama</th>
                                            <td><?php echo $data['pegawai_nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>OPD Asal</th>
                                            <td><?php echo $data['opd_asal_nama']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box box-blue">
                            <div class="box-header with-border">
                                <h3 class="box-title">Catatan Data</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:30%">Status</th>
                                            <td><?php echo $data['status']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Kirim</th>
                                            <td><?php echo content_tgl_indo(explode(' ', $data['ts'])[0]) . ', ' . explode(' ', $data['ts'])[1]; ?></td>
                                        </tr>
                                        <tr <?php echo ($data['status'] == 'Dikirim' ? 'style="display: none;"' : ''); ?>>
                                            <th>Waktu Terima</th>
                                            <td><?php echo content_tgl_indo(explode(' ', $data['tr'])[0]) . ', ' . explode(' ', $data['tr'])[1]; ?></td>
                                        </tr>
                                        <tr <?php echo ($data['status'] == 'Ditolak' ? '' : 'style="display: none;"'); ?>>
                                            <th>Alasan</th>
                                            <td><?php echo $data['alasan']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
if ($data['status'] == 'Diperiksa') {
    ?>
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Verifikasi</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <form class="form-horizontal" id="FormVerifikasiMutasiKepangkatan" method="post" action="<?php echo SIMPEG_URL; ?>controllers/c-layanan-kepegawaian.php" enctype="multipart/form-data">
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
                                    <button type="submit" class="btn btn-sm btn-primary" id="TombolVerifikasiMutasiKepangkatan" name="TombolVerifikasiMutasiKepangkatan">Simpan</button>
                                    <a href="../" class="btn btn-sm btn-default">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

<?php
}
?>
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