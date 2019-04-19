<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="item_unit_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="item_unit_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/item_unit/create'; ?>" data-update_url="<?= base_url().'app/item_unit/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Item Unit Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="item_unit_primary" id="item_unit_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control" name="item_unit_company" id="item_unit_company">
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
                                        <label>Name</label>
                                        <input type="text" name="item_unit_name" id="item_unit_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name="item_unit_description" id="item_unit_description"></textarea>
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
