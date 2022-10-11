<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Rekapitulasi Presensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item">Rekapitulasi Presensi</li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
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

                                    <form action="#" id="rekapitulasiPresensiForm" method="post" target="_blank">
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Periode <span class="text-danger">*</span></label>
                                            <input name="periode" type="month" class="form-control form-control-border border-width-2" id="inputPeriode" value="<?= date("Y-m"); ?>" autocomplete=" off" required placeholder="Pilih Periode">
                                            <span class='form-control-feedback text-danger'></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                Laporan Rekapitulasi Presensi
                                <br>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table id="tableRekapitulasiPresensi" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pegawai</th>
                                                <th>Jabatan</th>
                                                <th>Jumlah Hari Kerja</th>
                                                <th>Tidak Hadir</th>
                                                <th>Telat / Pulang Cepat</th>
                                                <th>Tidak Hadir Rapat</th>
                                                <th>Pengurangan TPP</th>
                                                <th>Presentase Disiplin Kerja</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url() . 'assets/js/laporan_rekapitulasi_presensi.js'; ?>"></script>