<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Rekapitulasi Presensi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Rekapitulasi Presensi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            
        <form action="#" id="rekapitulasiPresensiForm" method="post" target="_blank">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success card-outline">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Periode <span class="text-danger">*</span></label>
                                            <input name="periode" type="month" class="form-control form-control-border border-width-2" id="inputPeriode" value="<?= date("Y-m"); ?>" autocomplete=" off" required placeholder="Pilih Periode">
                                            <span class='form-control-feedback text-danger'></span>
                                        </div>
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
                                Daftar Rekapitulasi Presensi
                                <br>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Pegawai <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-border" id="inputPegawai" name="pegawai" required>
                                                        <option value="">-- Pilih Pegawai --</option>
                                                    </select>
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Jumlah Hari Kerja <span class="text-danger">*</span></label>
                                                    <input name="jumlah_hari_kerja" type="number" class="form-control form-control-border border-width-2" id="inputJumlahHariKerja" autocomplete="off" min="0" max="100" required placeholder="Masukkan Jumlah Hari Kerja">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Tidak Hadir <span class="text-danger">*</span></label>
                                                    <input name="tidak_hadir" type="number" class="form-control form-control-border border-width-2" id="inputTidakHadir" autocomplete="off" min="0" max="100" required placeholder="Masukkan Tidak Hadir">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Telat / Pulang Cepat<span class="text-danger">*</span></label>
                                                    <input name="dl_pc" type="number" class="form-control form-control-border border-width-2" id="inputDlPc" autocomplete="off" min="0" max="100" required placeholder="Masukkan Telat / Pulang Cepat">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Tidak Hadir Rapat <span class="text-danger">*</span></label>
                                                    <input name="tidak_hadir_rapat" type="number" class="form-control form-control-border border-width-2" id="inputTidakHadirRapat" autocomplete="off" min="0" max="100" required placeholder="Masukkan Tidak Hadir Rapat">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Pengurangan TPP <span class="text-danger">*</span></label>
                                                    <input name="pengurangan_tpp" type="number" class="form-control form-control-border border-width-2" id="inputPenguranganTPP" autocomplete="off" min="0" max="100" required placeholder="Masukkan Pengurangan TPP">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Presentase Disiplin Kerja<span class="text-danger">*</span></label>
                                                    <input name="presentase_disiplin_kerja" type="number" class="form-control form-control-border border-width-2" id="inputPresentaseDisiplinKerja" autocomplete="off" min="0" max="100" required placeholder="Masukkan Presentase Disiplin Kerja">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" id="btnSave" class="btn btn-primary">Simpan</button>
                                                <button type="button" id="btnUpdate" class="btn btn-success">Update</button>
                                                <button type="reset" id="btnCancel" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr>
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
<script src="<?= base_url() . 'assets/js/rekapitulasi_presensi.js'; ?>"></script>