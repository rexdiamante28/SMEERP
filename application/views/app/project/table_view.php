<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    <section class="tables">   
        <div class="container-fluid">
            <section class="tables">   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8">
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="border-top-gray">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-group">
                                                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="searchtext">
                                                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="button" id="search_trigger_btn">
                                                                <i class="fa fa-search no-margin"></i>
                                                            </button>
                                                            <?php
                                                                if($this->loginstate->get_access()['overall_access']==1)
                                                                {
                                                                    ?>
                                                                        <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="project_create_btn">
                                                                            <i class="fa fa-plus"></i>
                                                                            Add New
                                                                        </button>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover table-bordered table-grid" id="table-grid">
                                        <thead>
                                            <tr>
                                                <th>Project Name</th>
                                                <th>Category</th>
                                                <th>Progress</th>
                                                <th>Priority</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
