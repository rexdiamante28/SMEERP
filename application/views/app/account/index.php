<div class="content-inner" id="pageActive" data-num="3" data-namecollapse="" data-labelname="">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
            <div class="row m-b-sm">
                <div class="col-lg-12">
                    <div class="row">

                        <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/company/list/'); ?>" class="w-100">

                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Users</div>
                                                <small class="card-text text-black-50">List of users enrolled in the system</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/member/view/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">People</div>
                                                <small class="card-text text-black-50">List of all people under enrolled companies</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/member/view/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Employees</div>
                                                <small class="card-text text-black-50">List of all employees under enrolled companies</small>
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
<!--  <div class="content-inner" id="pageActive" data-num="3" data-namecollapse="" data-labelname="">
    Page Header
    <?= $breadcrumb; ?>
    <div class="row m-b-sm">
        <div class="col-lg-12">
            <div class="row">
                <?php
                    if($this->loginstate->get_access()['overall_access'] == 1)
                    {
                        ?>
                            <div class="col-md-6">
                                <a href="<?= base_url('app/account/view/'.$id); ?>" class="w-100">
                                    <div class="card card-option card-hover white p-3 mb-3 w-100">
                                        <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                        <div class="card-header-title font-weight-bold">Profile</div>
                                        <small class="card-text text-black-50">Profile Information</small>
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
                            <div class="col-md-6">
                                <a href="<?= base_url('app/account/change_password/'.$id); ?>" class="w-100">
                                    <div class="card card-option card-hover white p-3 mb-3 w-100">
                                        <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                        <div class="card-header-title font-weight-bold">Change Password</div>
                                        <small class="card-text text-black-50">Change Password</small>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>
</div> -->