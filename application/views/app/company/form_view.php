<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="company_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="company_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/company/create'; ?>" data-update_url="<?= base_url().'app/company/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Company Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="company_primary" id="company_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="company_name" id="company_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="company_description" id="company_description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Industry</label>
                                        <select class="form-control" name="company_industry" id="company_industry">
                                            <option value="">-- Select Industry --</option>
                                            <?php
                                                foreach ($industries as $industry) {
                                                    ?>
                                                        <option value="<?= en_dec('en',$industry['id']); ?>"><?= $industry['name']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
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
