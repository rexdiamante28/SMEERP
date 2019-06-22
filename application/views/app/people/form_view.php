<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="people_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="people_create_form" enctype="multipart/form-data" method="post" data-create_url = "<?= base_url().'app/people/create'; ?>" data-update_url="<?= base_url().'app/people/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">People Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <div class="form-group hidden">
                                        <input type="password" value="0" name="people_primary" id="people_primary"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="people_fname" id="people_fname" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <textarea name="people_mname" id="people_mname" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <textarea name="people_lname" id="people_lname" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <textarea name="people_contact" id="people_contact" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="people_address" id="people_address" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>User</label>
                                        <select class="form-control select2" name="people_user" id="people_user">
                                            <option value="">-- Select User --</option>
                                            <?php
                                                foreach ($user as $usr) {
                                                    ?>
                                                        <option value="<?= en_dec('en',$usr['id']); ?>"><?= $usr['username']  ?></option>
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
