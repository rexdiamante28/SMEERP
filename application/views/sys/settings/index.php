<div class="content-inner" id="pageActive" data-num="4" data-namecollapse="" data-labelname="Settings">
    <!-- Page Header-->
    <?= $breadcrumb; ?>
    
    <section class="tables">   
        <div class="container-fluid">
            <div class="row m-b-sm">
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                            if($this->loginstate->get_access()['overall_access']==1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('sys/users/list_users'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/avatar.png")?>" alt="" class="img">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Users</div>
                                                <small class="card-text text-black-50">List of all users in the system</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>

                        <?php
                            if($this->loginstate->get_access()['overall_access']==1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('sys/access_control/list_templates'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/connection.png")?>" alt="" class="img">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Access Control Templates</div>
                                                <small class="card-text text-black-50">Access control templates for faster access granting</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>

                        <?php
                            if($this->loginstate->get_access()['overall_access']==1)
                            {
                                ?>
                                    <div class="col-lg-2 col-md-3">
                                        <a href="<?= base_url('sys/users/change_password'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/lock.png")?>" alt="" class="img">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Change Password</div>
                                                <small class="card-text text-black-50">Change password for security purposes</small>
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
    </section>
</div>