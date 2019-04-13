<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="project_task_group_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-md">
                    <div class="modal-content">
                        <form id="project_task_group_create_form" enctype="multipart/form-data" method="post" action="" data-create_url = "<?= base_url().'app/project_task_group/create'; ?>" data-update_url="<?= base_url().'app/project_task_group/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Project Group</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <!--Every form must have an ID field to be used for update operations-->
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" name="project_task_group_id" id="project_task_group_id" class="form-control" value="0" >
                                            </div>
                                        </div>
                                    </div>
                                        <!--Every form must have an ID field to be used for update operations-->

                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Parent Group</label>
                                                <input type="text" name="project_group_parent_group" id="project_group_parent_group" class="form-control" placeholder="Parent group">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Group Name</label>
                                                <input type="text" name="project_group_name" id="project_group_name" class="form-control" placeholder="Group Name">
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