<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    
    <section class="tables">   
        <div class="container-fluid">
            <section class="tables">   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border-top-gray" id="searchRN">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input style="visibility:hidden;" type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="searchtext">
                                                            <button style="visibility:hidden;"  class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="button" id="searchBtn">
                                                                <i class="fa fa-search no-margin"></i>
                                                            </button>
                                                            <?php
                                                                if($this->loginstate->get_access()['admin']['settings']['dragonpay_rates']['create']==1)
                                                                {
                                                                    ?>
                                                                        <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="newrate_btn">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add New
                                                                        </button>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered table-grid" id="table-grid">
                                        <thead>
                                            <tr>
                                                <th>Online Bank</th>
                                                <th>OTC Bank</th>
                                                <th>OTC Non-Bank</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>




<?php
    if($this->loginstate->get_access()['admin']['settings']['dragonpay_rates']['create']==1)
    {
        ?>
            <!-- Modals-->
            <div id="add_rate_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="col-md-12">
                                <h4 id="exampleModalLabel" class="modal-title">Dragonpay Rates</h4>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <?php echo form_open_multipart(base_url().'sys/settings/add_dragonpay_rate',array('id'=>'dragonapay_rate_form','method'=>'post')) ?>
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="text" name="f_id" id="f_id" class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <div class="form-group">
                                                <label>Online Bank (PHP)</label>
                                                <input type="number" name="f_online_bank" id="f_online_bank" class="form-control" placeholder="Online Bank">
                                            </div>
                                            <div class="form-group">
                                                <label>OTC Bank (PHP)</label>
                                                <input type="number" name="f_otc_bank" id="f_otc_bank" class="form-control" placeholder="OTC Bank">
                                            </div>
                                            <div class="form-group">
                                                <label>OTC Non-Bank (PHP)</label>
                                                <input type="number" name="f_otc_non_bank" id="f_otc_non_bank" class="form-control" placeholder="OTC Non-Bank">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-default cancelBtn waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
                                <button type="button" id="initiate_btn" class="btn btn-primary  waves-effect waves-light">
                                    <i class="fa fa-save"></i>
                                    <span>Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>



<div id="bank_account_delete_prompt_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-12">
                    <h4 id="exampleModalLabel" class="modal-title">Bank Account Deletion</h4>
                </div>
            </div>
                <div class="modal-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <h5>Are you sure you want to delete this account?</h5>
                                    <input type="text" name="bank_account_number_delete" id="bank_account_number_delete" class="form-control hidden" placeholder="Account Number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-right">
                        <button type="button" class="btn btn-default cancelBtn waves-effect waves-light btn-sm" data-dismiss="modal" aria-label="Close">No</button>
                        <button type="button" id="initiate_bank_account_delete_btn" class="btn btn-primary  waves-effect waves-light">
                            <i class="fa fa-save"></i>
                            <span>Yes</span>
                        </button>
                    </div>
                </div>
        </div>
    </div>
</div>
