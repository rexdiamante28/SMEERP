<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="branch_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="branch_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/branch/create'; ?>" data-update_url="<?= base_url().'app/branch/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Company Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="branch_primary" id="branch_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control select2" name="branch_company" id="branch_company">
                                            <option value="">-- Select Company --</option>
                                            <?php
                                                foreach ($companies as $company) {
                                                    ?>
                                                        <option value="<?= en_dec('en',$company['id']); ?>"><?= $company['name']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <input type="text" name="branch_name" id="branch_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="branch_description" id="branch_description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="branch_address" id="branch_address" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
                                    <button type="submit"  class="btn btn-primary waves-effect waves-light">
                                        <i class="fa fa-save"></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
    }
?>
