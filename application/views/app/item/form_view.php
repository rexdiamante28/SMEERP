<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="item_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="item_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/item/create'; ?>" data-update_url="<?= base_url().'app/item/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Item Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="item_primary" id="item_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Item Image</label>
                                                <input type="file" name="item_image" id="item_image" class="">
                                            </div>
                                            <div class="col-12">
                                                <label>Has Unique Identifier</label>
                                                <input type="checkbox" name="item_unique_identifier" id="item_unique_identifier" class="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control" name="item_company" id="item_company">
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
                                    <div class="form-group hidden" id="item_category_group">
                                        <label>Category</label>
                                        <select class="form-control" name="item_category" id="item_category">
                                        </select>
                                    </div>
                                    <div class="form-group hidden" id="item_unit_group">
                                        <label>Unit</label>
                                        <select class="form-control" name="item_unit" id="item_unit">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Item Code</label>
                                        <input type="text" name="item_code" id="item_code" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input type="text" name="item_name" id="item_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Generic Name</label>
                                        <input type="text" name="item_generic_name" id="item_generic_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Item Description</label>
                                        <textarea name="item_description" id="item_description" class="form-control"></textarea>
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
