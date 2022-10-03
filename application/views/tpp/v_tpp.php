<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">TPP</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">TPP</li>
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
                                Pilih Periode TPP
                                <br>
                            </div>
                        </div>
                        <div class="card-body">

                            <form action="<?= base_url('Tpp/ProsesHitungTPP'); ?>" id="tppForm" method="post" target="_blank">
                                <?php
                                if ($this->session->flashdata('error')) {
                                ?>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                            <div class="alert alert-sm alert-danger alert-dismissible">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <h4><i class="icon fa fa-ban"></i> Perhatian !</h4>
                                                <?php
                                                echo $this->session->flashdata('error');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-12">

                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Periode <span class="text-danger">*</span></label>
                                            <input name="periode" type="month" class="form-control form-control-border border-width-2" id="inputPeriode" value="<?= date("Y-m"); ?>" autocomplete=" off" required placeholder="Pilih Periode">
                                            <span class='form-control-feedback text-danger'></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" id="btnSave" class="btn btn-primary">Proses Hitung TPP</button>
                                        <button type="reset" id="btnCancel" class="btn btn-secondary">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url() . 'assets/js/besaran_tpp.js'; ?>"></script>