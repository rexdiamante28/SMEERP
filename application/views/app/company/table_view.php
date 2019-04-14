<div class="" id="pageActive" data-num="3"></div>

<?= $breadcrumb; ?>

<div class="content-container">
    <div class="row">
        <div class="col-lg-6">
        </div>
        <div class="col-lg-6">
            <div class="border-top-gray">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="company_searchtext">
                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="button" id="search_trigger_btn">
                                <i class="fa fa-search no-margin"></i>
                            </button>
                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <a href="<?= base_url('app/company/create'); ?>">
                                            <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="company_create_btn">
                                                <i class="fa fa-plus"></i>
                                                Add
                                            </button>
                                        </a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br/>

    <table class="table table-striped table-hover table-bordered table-grid" id="company-table-grid">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Industry</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>