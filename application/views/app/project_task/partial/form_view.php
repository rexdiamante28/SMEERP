<?php
    if($this->loginstate->get_access()['overall_access']==1)
    {
        ?>
            <div id="project_task_create_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="project_task_create_form" enctype="multipart/form-data" method="post" action="" data-create_url = "<?= base_url().'app/project_task/create'; ?>" data-update_url="<?= base_url().'app/project_task/update'; ?>" >
                            <div class="modal-header">
                                <div class="col-md-12">
                                    <h4 class="modal-title">Project Task</h4>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <!--Every form must have an ID field to be used for update operations-->
                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <input type="password" name="project_task_task_id" id="project_task_task_id" class="form-control" value="0" >
                                            </div>
                                        </div>
                                    </div>
                                        <!--Every form must have an ID field to be used for update operations-->

                                    <div class="row hidden">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Parent Group</label>
                                                <input type="text" name="project_task_task_group" id="project_task_task_group" class="form-control" placeholder="Parent group">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Task Name</label>
                                                <input type="text" name="project_task_task_name" id="project_task_task_name" class="form-control" placeholder="Task Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <div id="editor" class="pell"></div>
                                                <textarea class="form-control hidden" name="project_task_description" id="project_task_description" placeholder="Task Description"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Task Priority</label>
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

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Man Hours</label>
                                                <input type="number" name="project_task_man_hours" id="project_task_man_hours" class="form-control" placeholder="Man Hours">
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Weight</label>
                                                <input type="number" name="project_task_weight" id="project_task_weight" class="form-control" placeholder="Task Weight">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group">
                                                <label>Task Status</label>
                                                <select class="form-control" id="project_task_status" name="project_task_status">
                                                    <option value="0">Select Status</option>
                                                    <?php
                                                        foreach ($project_task_status_options as $option) {
                                                            ?>
                                                                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label>Target Start Date</label>
                                                <input type="date" name="project_task_start_date" id="project_task_start_date" class="form-control" placeholder="Start Date">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <label>Target Deadline</label>
                                                <input type="date" name="project_task_deadline" id="project_task_deadline" class="form-control" placeholder="Deadline">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Task Assignee(s)</label>
                                                <select class="form-control chosen-select" multiple id="project_task_assignee" name="project_task_assignee[]">
                                                    <?php
                                                        foreach ($contributors as $contributor) {
                                                            ?>
                                                                <option value="<?= $contributor['id'] ?>"><?= $contributor['name'] ?></option>
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