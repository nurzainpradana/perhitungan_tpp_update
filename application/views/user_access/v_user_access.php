<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Access</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">User Access</li>
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
                        <div class="card-header">
                            <div class="card-title">
                                Daftar User Access
                                <br>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form action="#" id="userAccessForm" method="post" target="_blank">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Pegawai <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-border" id="inputPegawai" name="pegawai" required>
                                                        <option value="">-- Pilih Pegawai --</option>
                                                    </select>
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">User ID <span class="text-danger">*</span></label>
                                                    <input name="user_id" type="text" class="form-control form-control-border border-width-2" id="inputUserID" autocomplete="off" required placeholder="Input User ID">
                                                    <input name="id_user_access" type="text" class="form-control form-control-border border-width-2" id="inputIdUserAccess" autocomplete="off" required placeholder="Input Id User Access" hidden>
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Level User</label>
                                                    <select class="form-control form-control-border" id="inputLevel" name="level_user" required>
                                                        <option value="">-- Pilih Level User --</option>
                                                        <option value="1">Admin Umpeg</option>
                                                        <option value="2">Admin Keuangan</option>
                                                        <option value="3">Kasubag Umpeg</option>
                                                        <option value="4">Camat</option>
                                                    </select>
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Password <span class="text-danger">*</span></label>
                                                    <input name="password" type="password" class="form-control form-control-border border-width-2" id="inputPassword" autocomplete="off" required placeholder="Input Password">
                                                    <span class='form-control-feedback text-danger'></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleSelectBorder">Status <span class="text-danger">*</span></label>
                                                    <select class="form-control form-control-border" id="inputStatus" name="status" required>
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="1">Aktif</option>
                                                        <option value="0">Non Aktif</option>
                                                    </select>
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
                                    <table id="tableUserAccess" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pegawai</th>
                                                <th>Username</th>
                                                <th>Level</th>
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
<script src="<?= base_url() . 'assets/js/user_access.js'; ?>"></script>