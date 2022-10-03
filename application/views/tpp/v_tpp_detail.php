<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0">PERHITUNGAN TAMBAHAN PENGHASILAN KECATAMAN SETU KABUPATEN BEKASI <br><b> BULAN <?= $periode; ?></b></h3>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tableTPPDetail" class="table table-sm text-sm table-bordered table-striped table-responsive text-center">
                                        <thead class="text-bold">
                                            <tr>
                                                <th rowspan="4">NAMA</th>
                                                <th rowspan="4">JABATAN</th>
                                                <th colspan="5">BESARAN TPP</th>
                                                <th colspan="6">DISIPLIN KERJA</th>
                                                <th colspan="6">PRODUKTIVITAS KERJA</th>
                                                <th rowspan="4">TAMBAHAN TPP</th>
                                                <th rowspan="4">PENGURANGAN TPP</th>
                                                <th rowspan="4">JUMLAH TPP DITERIMA</th>
                                            </tr>
                                            <tr>
                                                <th colspan="5"></th>
                                                <th></th>
                                                <th colspan="5">40%</th>
                                                <th></th>
                                                <th colspan="5">60 %</th>
                                            </tr>
                                            <tr>
                                                <th>BEBAN KERJA</th>
                                                <th>PRESTASI KERJA</th>
                                                <th>KONDISI KERJA</th>
                                                <th>KELANGKAAN PROFESI</th>
                                                <th>TOTAL TPP</th>
                                                <th>NILAI</th>
                                                <th>BEBAN KERJA</th>
                                                <th>PRESTASI KERJA</th>
                                                <th>KONDISI KERJA</th>
                                                <th>KELANGKAAN PROFESI</th>
                                                <th>DITERIMA</th>
                                                <th>NILAI</th>
                                                <th>BEBAN KERJA</th>
                                                <th>PRESTASI KERJA</th>
                                                <th>KONDISI KERJA</th>
                                                <th>KELANGKAAN PROFESI</th>
                                                <th>DITERIMA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($result as $item) {
                                            ?>

                                                <tr>
                                                    <td class="text-left"><?= $item->nama; ?></td>
                                                    <td class="text-left"><?= $item->nama_jabatan; ?></td>
                                                    <td class="text-left"><?= $item->tpp_beban_kerja > 0 ? "Rp " . number_format($item->tpp_beban_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->tpp_prestasi_kerja > 0 ? "Rp " . number_format($item->tpp_prestasi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->tpp_kondisi_kerja > 0 ? "Rp " . number_format($item->tpp_kondisi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->tpp_kelangkaan_profesi > 0 ? "Rp " . number_format($item->tpp_kelangkaan_profesi, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->total_tpp > 0 ? "Rp " . number_format($item->total_tpp, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->nilai_disiplin_kerja ? $item->nilai_disiplin_kerja . " %" : 0; ?></td>

                                                    <td class="text-left"><?= $item->dis_kerja_beban_kerja > 0 ? "Rp " . number_format($item->dis_kerja_beban_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->dis_kerja_prestasi_kerja > 0 ? "Rp " . number_format($item->dis_kerja_prestasi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->dis_kerja_kondisi_kerja > 0 ? "Rp " . number_format($item->dis_kerja_kondisi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->dis_kerja_kelangkaan_profesi > 0 ? "Rp " . number_format($item->dis_kerja_kelangkaan_profesi, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->dis_kerja_diterima > 0 ? "Rp " . number_format($item->dis_kerja_diterima, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->nilai_produktivitas_kerja ? $item->nilai_produktivitas_kerja . " %" : 0; ?></td>


                                                    <td class="text-left"><?= $item->prod_kerja_beban_kerja > 0 ? "Rp " . number_format($item->prod_kerja_beban_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->prod_kerja_prestasi_kerja > 0 ? "Rp " . number_format($item->prod_kerja_prestasi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->prod_kerja_kondisi_kerja > 0 ? "Rp " . number_format($item->prod_kerja_kondisi_kerja, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->prod_kerja_kelangkaan_profesi > 0 ? "Rp " . number_format($item->prod_kerja_kelangkaan_profesi, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->prod_kerja_diterima > 0 ? "Rp " . number_format($item->prod_kerja_diterima, 2, ',', '.') : 0; ?></td>


                                                    <td class="text-left"><?= $item->tambahan_tpp > 0 ? "Rp " . number_format($item->tambahan_tpp, 2, ',', '.') : 0; ?></td>
                                                    <td class="text-left"><?= $item->tambahan_tpp > 0 ? "Rp " . number_format($item->pengurangan_tpp, 2, ',', '.') : 0; ?></td>

                                                    <td class="text-left"><?= $item->jumlah_tpp_diterima > 0 ? "Rp " . number_format($item->jumlah_tpp_diterima, 2, ',', '.') : 0; ?></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <form method="POST" target="_blank" action="<?= base_url("/TPP/cetakTPP"); ?>">
                                <input type="text" name="periode" value="<?= $periode_ori; ?>" hidden required>
                                <button type="submit" class="btn btn-success">Cetak TPP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url() . 'assets/js/rekapitulasi_presensi.js'; ?>"></script>