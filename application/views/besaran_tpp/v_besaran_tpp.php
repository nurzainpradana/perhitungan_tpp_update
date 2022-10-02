<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Besaran TPP</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Besaran TPP</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <form action="#" id="besaranTppForm" method="post" target="_blank">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <div class="card-title">
                                    Daftar Besaran TPP
                                    <br>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Jabatan <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-border" id="inputJabatan" name="jabatan" required>
                                                        <option value="">-- Pilih Jabatan --</option>
                                                    </select>
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Beban Kerja <span class="text-danger">*</span></label>
                                                    <input name="beban_kerja" type="number" class="form-control form-control-border border-width-2" id="inputBebanKerja" autocomplete="off" min="0" required placeholder="Masukkan Beban Kerja">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Prestasi Kerja <span class="text-danger">*</span></label>
                                                    <input name="prestasi_kerja" type="number" class="form-control form-control-border border-width-2" id="inputPrestasiKerja" autocomplete="off" min="0" required placeholder="Masukkan Prestasi Kerja">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Kondisi Kerja <span class="text-danger">*</span></label>
                                                    <input name="kondisi_kerja" type="number" class="form-control form-control-border border-width-2" id="inputKondisiKerja" autocomplete="off" min="0" required placeholder="Masukkan Kondisi Kerja">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Kelangkaan Profesi <span class="text-danger">*</span></label>
                                                    <input name="kelangkaan_profesi" type="number" class="form-control form-control-border border-width-2" id="inputKelangkaanProfesi" autocomplete="off" min="0" required placeholder="Masukkan Kelangkaan Profesi">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Tambahan TPP <span class="text-danger">*</span></label>
                                                    <input name="tambahan_tpp" type="number" class="form-control form-control-border border-width-2" id="inputTambahanTpp" autocomplete="off" min="0" required placeholder="Masukkan Tambahan TPP">
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
            <table id="tableBesaranTpp" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Jabatan</th>
                        <th>Beban Kerja</th>
                        <th>Prestasi Kerja</th>
                        <th>Kondisi Kerja</th>
                        <th>Kelangkaan Profesi</th>
                        <th>Tambahan TPP</th>
                        <th>Total TPP</th>
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
<script src="<?= base_url() . 'assets/js/besaran_tpp.js'; ?>"></script>