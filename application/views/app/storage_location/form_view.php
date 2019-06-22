<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="storage_location_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="storage_location_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/storage_location/create'; ?>" data-update_url="<?= base_url().'app/storage_location/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Storage Location Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="storage_location_primary" id="storage_location_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control" name="storage_location_company" id="storage_location_company">
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
                                    <div class="form-group hidden" id="storage_location_branch_group">
                                        <label>Branch</label>
                                        <select class="form-control" name="storage_location_branch" id="storage_location_branch">
                                        </select>
                                    </div>
                                    <div class="form-group hidden" id="storage_location_storage_location_group">
                                        <label>Parent Location</label>
                                        <select class="form-control" name="storage_location_parent_location" id="storage_location_parent_location">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="storage_location_name" id="storage_location_name" class="form-control">
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
