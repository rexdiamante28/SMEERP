<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="project_contributor_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form id="project_contributor_create_form" enctype="multipart/form-data" method="post" action="" data-create_url = "<?= base_url().'app/project_contributor/create'; ?>" data-update_url="<?= base_url().'app/project_contributor/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Project Contributor</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <!--Every form must have an ID field to be used for update operations-->
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" name="project_contributor_id" id="project_contributor_id" class="form-control" value="0" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Member</label>
                                                <select class="form-control" id="project_contributor_member" name="project_contributor_member">
                                                    <option value="">Select Member</option>
                                                    <?php
                                                        foreach ($members as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['fname'].' '.$option['mname'].' '.$option['lname'];  ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control" id="project_contributor_role" name="project_contributor_role">
                                                    <option value="">Select Role</option>
                                                    <?php
                                                        foreach ($roles as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['role'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
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