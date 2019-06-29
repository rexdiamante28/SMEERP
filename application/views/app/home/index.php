<div class="content-inner" id="pageActive" data-num="1" data-namecollapse="" data-labelname="">
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
                                        <a href="<?= base_url('app/account/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/user.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Account</div>
                                                <small class="card-text text-black-50">Account Shortcut</small>
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
                                        <a href="<?= base_url('app/general/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/menu.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">General</div>
                                                <small class="card-text text-black-50">General Shortcut</small>
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
                                        <a href="<?= base_url('app/inventory/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/storage.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Inventory</div>
                                                <small class="card-text text-black-50">Inventory Shortcut</small>
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
                                        <a href="<?= base_url('app/sales/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/percentage.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Sales</div>
                                                <small class="card-text text-black-50">Sales Shortcut</small>
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
                                        <a href="<?= base_url('app/procurement/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/delivery.png")?>" alt="">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Procurement</div>
                                                <small class="card-text text-black-50">Procurement Shortcut</small>
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