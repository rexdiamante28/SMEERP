<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="" data-labelname="">
    <input type="text" class="hidden" id="view_project_project_id" value="<?= $project_id; ?>">
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
                                            
                                        </div>
                                    </div>
                                    <br/>
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item" id="project_tasks_tab_btn">
                                          <a class="nav-link active" data-toggle="tab" href="#project_tasks_tab">Tasks</a>
                                        </li>
                                        <li class="nav-item" id="project_roles_tab_btn">
                                          <a class="nav-link" data-toggle="tab" href="#project_roles_tab">Roles</a>
                                        </li>
                                        <li class="nav-item" id="project_contributors_tab_btn">
                                          <a class="nav-link" data-toggle="tab" href="#project_contributors_tab">Contributors</a>
                                        </li>
                                        <li class="nav-item hidden">
                                          <a class="nav-link" data-toggle="tab" href="#project_files_tab">Files</a>
                                        </li>
                                        <li class="nav-item hidden">
                                          <a class="nav-link" data-toggle="tab" href="#project_notes_tab">Notes</a>
                                        </li>
                                        <li class="nav-item hidden">
                                          <a class="nav-link" data-toggle="tab" href="#project_issues_tab">Issues</a>
                                        </li>
                                        <li class="nav-item" id="project_logs_tab_btn">
                                          <a class="nav-link" data-toggle="tab" href="#project_logs_tab">Logs</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane container active" id="project_tasks_tab">
                                            <br/>
                                            <div class="row">
                                                <button class="btn btn-primary" id="project_group_create_btn">Root Group</button>
                                            </div>
                                            <br/><br/>
                                            <div class="" id="project_tasks_tab_content">
                                                <ul id="tasks_ul">
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_roles_tab">
                                            <br/>
                                            <div class="row">
                                                <button class="btn btn-primary pull-right" id="project_role_create_btn">Add</button>
                                            </div>
                                            <br/><br/>
                                            <div class="row" id="project_roles_tab_content">
                                                <table class="table table-striped table-hover table-bordered table-grid" id="project_role_table_grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Role</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_contributors_tab">
                                            <br/>
                                            <div class="row">
                                                <button class="btn btn-primary pull-right" id="project_contributor_create_btn">Add</button>
                                            </div>
                                            <br/><br/>
                                            <div class="row" id="project_roles_tab_content">
                                                <table class="table table-striped table-hover table-bordered table-grid" id="project_contributor_table_grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Role</th>
                                                            <th>Contributor</th>
                                                            <th>Progress</th>
                                                            <th>Email</th>
                                                            <th>Mobile Number</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_files_tab">
                                            <br/><br/>
                                            <div class="row">
                                                <h1 class="text-center">Under Construction</h1>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_notes_tab">
                                            <br/><br/>
                                            <div class="row">
                                                <h1 class="text-center">Under Construction</h1>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_issues_tab">
                                            <br/><br/>
                                            <div class="row">
                                                <h1 class="text-center">Under Construction</h1>
                                            </div>
                                        </div>

                                        <div class="tab-pane container" id="project_logs_tab">
                                            <br/>
                                            <div class="row">
                                                <button class="btn btn-primary pull-right" id="project_log_create_btn">Add Log</button>
                                            </div>
                                            <br/><br/>
                                            <div class="row" id="project_logs_tab_content">
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
