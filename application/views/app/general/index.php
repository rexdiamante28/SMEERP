<div class="content-inner" id="pageActive" data-num="2" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
            <div class="row m-b-sm">
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('app/company/list/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/enterprise.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Companies</div>
                                                <small class="card-text text-black-50">List of companies enrolled in the system</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>


                        <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('app/branch/list/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/building.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Branches</div>
                                                <small class="card-text text-black-50">List of branches under enrolled companies</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>

                        <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('app/member/view/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/employees.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Employees</div>
                                                <small class="card-text text-black-50">List of employees under enrolled companies</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>

                        <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('app/industry/list/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/factory.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Industries</div>
                                                <small class="card-text text-black-50">List of employees under enrolled companies</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
</div>