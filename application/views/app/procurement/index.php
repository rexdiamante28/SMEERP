<div class="content-inner" id="pageActive" data-num="6" data-namecollapse="" data-labelname="">
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
                                        <a href="<?= base_url('app/item_category/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/distribution.png")?>" alt="" class="img">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Suppliers</div>
                                                <small class="card-text text-black-50">lorem ipsum dolor sit amet</small>
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
                                        <a href="<?= base_url('app/item_category/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="card-logo">
                                                    <img src="<?=base_url("assets/img/box.png")?>" alt="" class="img">
                                                </div>
                                                <div class="card-header-title font-weight-bold">Orders</div>
                                                <small class="card-text text-black-50">lorem ipsum dolor sit amet</small>
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