<!-- Content Wrapper. Contains page content -->
<div class="loading"></div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Voucher Out</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Voucher Out</li>
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
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <!-- <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleSelectBorder">Payment To</label>
                                            <select class="form-control form-control-border" id="inputPaymentTo" required>
                                                <option value="">-- Choose Payment To --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Bank Name</label>
                                        <select class="form-control form-control-border" id="inputBank" required>
                                            <option value="">-- Choose Bank Name --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Currency</label>
                                        <select class="form-control form-control-border" id="inputCurrency" required>
                                            <option value="">-- Choose Currency --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Factory</label>
                                        <select class="form-control form-control-border" id="inputFactory" required>
                                            <option value="">-- Choose Factory --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleSelectBorder">Location</label>
                                        <select class="form-control form-control-border" id="inputLocation" required>
                                            <option value="">-- Choose Location --</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleInputBorderWidth2">Payment To <code class="text-danger">*</code></label>
                                        <input name="payment_to" type="text" class="form-control form-control-border border-width-2" id="inputPaymentTo" autocomplete="off" required placeholder="Payment To">
                                        <span class='form-control-feedback text-danger'></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <button type="button" id="btnFilter" class="btn bg-navy">Filter</button>
                                    <button type="reset" id="btnCancel" class="btn btn-secondary">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="card-title">
                                Voucher Out List
                                <br>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" id="btnReturn" class="btn btn-primary text-right">Return</button>
                                    <br><br>
                                    <div class="custom-control custom-checkbox text-left p-0 m-0">
                                        <input class="" type="checkbox" id="btnSelectAll">
                                        <label for="btnSelectAll" class="">Select All</label>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table id="tableOutVoucher" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item Storage Code</th>
                                                <th>Voucher No</th>
                                                <th>Payment To</th>
                                                <th>Bank Name</th>
                                                <th>Currency</th>
                                                <th>Location</th>
                                                <th>Out Date</th>
                                                <th>Out By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <!-- MODAL -->
                                <div class="modal fade" id="inputReasonModal" tabindex="-1" role="dialog" aria-labelledby="inputReasonModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Vouchers Disposal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="exampleInputBorderWidth2">Input Reason <code class="text-danger">*</code></label>
                                                            <input name="reason" type="text" class="form-control form-control-border border-width-2" id="inputReason" required placeholder="Reason">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button id="btnProcessDisposal" type="button" class="btn btn-primary">Process</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            </div>
                            <div class="row">
                                <!-- MODAL -->
                                <div class="modal fade" id="inputUploadModal" tabindex="-1" role="dialog" aria-labelledby="inputUploadModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Softcopy Scan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <form id="formUpload"></form>
                                                        <input type="text" name="" id="inputVoucherNoUpload" hidden>
                                                        <span>Voucher No <span class="text-bold" id="spanVoucherNoUpload"></span></span>
                                                        <br><br>
                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="inputSoftcopyScan" accept="application/pdf">
                                                                <label class="custom-file-label" for="inputSoftcopyScan">Choose Softcopy Scan</label>
                                                                <span id="softcopyScanErrorFeedback" class="text-red">File is required</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="btnProcessUpload" type="button" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <!-- MODAL -->
                                    <div class="modal fade " id="modalPreviewPDF" tabindex="-1" role="dialog" aria-labelledby="modalPreviewPDFLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Preview Softcopy Scan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span>Voucher No <span class="text-bold" id="spanVoucherNoUploadPreview"></span></span>
                                                            <br><br>
                                                            <embed id="embedPdf" src="" frameborder="0" width="100%" height="400px">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END MODAL -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<script src="<?= base_url() . 'application/views/voucher_out/voucher_out.js'; ?>"></script>