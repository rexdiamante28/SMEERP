<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="project_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="project_create_form" enctype="multipart/form-data" method="post" action="" data-create_url = "<?= base_url().'app/project/create'; ?>" data-update_url="<?= base_url().'app/project/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Project Form</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <!--Every form must have an ID field to be used for update operations-->
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" name="project_id" id="project_id" class="form-control" value="0" >
                                            </div>
                                        </div>
                                    </div>
                                        <!--Every form must have an ID field to be used for update operations-->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="project_name" id="project_name" class="form-control" placeholder="Project Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div id="editor" class="pell"></div>
                                                <textarea class="form-control hidden" name="project_description" id="project_description" placeholder="Project Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Project Status</label>
                                                <select class="form-control" id="project_project_status" name="project_project_status">
                                                    <option value="0">Select Status</option>
                                                    <?php
                                                        foreach ($project_status_options as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Project Category</label>
                                                <select class="form-control" id="project_category" name="project_category">
                                                    <option value="0">Select Category</option>
                                                    <?php
                                                        foreach ($project_category_options as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Project Priority</label>
                                                <select class="form-control" id="project_priority" name="project_priority">
                                                    <option value="0">Select Priority</option>
                                                    <?php
                                                        foreach ($priority_options as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['priority'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Progress</label>
                                                <input type="number" name="project_progress" id="project_progress" class="form-control" placeholder="Project Progress">
                                            </div>
                                        </div>
                                    </div> -->

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