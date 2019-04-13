<style type="text/css">
    .tile{
        border:1px dotted gray;
        padding: 3px 5px;
        border-radius: 10px;
        background-color: #86bc42;
        color: white;
    }
    .tile > img{
        width:30px;
    }
</style>
<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="" data-labelname="">
    <input type="text" class="hidden" id="view_project_task_task_id" value="<?= en_dec('en',$task['id']); ?>">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    <section class="tables">   
        <div class="container-fluid">
            <section class="tables">   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12" id="project_details_partial_view_location">
                                            <button id="update_project_task_btn" class="pull-right btn btn-primary">Update</button>
                                            <h4><?= $task['group_string']; ?></h4>
                                            <h1><?= $task['name']; ?></h1>
                                            <small>Created: <?= $task['created']; ?></small><br/>
                                            <small>Deadline: <?= $task['created']; ?></small><br/>
                                            <small>Status: <small class="status-indicator" style="background-color:<?= $task['color_code']; ?>"><?= $task['task_status']; ?></small></small><br/>
                                            <small>Priority: <small class="status-indicator" style="background-color:<?= $task['priority_color_code']; ?>"><?= $task['priority']; ?></small></small>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <?php
                                                            foreach ($task_assignees as $assignee) {
                                                                ?>
                                                                    <div class="col-xs-6 col-2">
                                                                        <div class="tile">
                                                                            <img  src="<?= base_url('assets/uploads/avatars/').$assignee['avatar']; ?>" class="img-fluid rounded-circle"><br/>
                                                                            <small><?= $assignee['name']; ?></small>
                                                                            <small><?= $assignee['email']; ?></small>
                                                                            <small><?= $assignee['mobile_number']; ?></small>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <?= $task['description']; ?>
                                            <hr/>
                                            <div id="project_task_logs_container" class="row">
                                                
                                            </div>
                                            <form method="post" action="<?= base_url('app/project_task_log/create'); ?>" id="project_task_log_create_form">
                                                <textarea class="form-control" name="project_task_log_log" placeholder="Write your comment here..."></textarea>
                                                <button class="btn btn-primary pull-right">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
