<div class="content-inner" id="pageActive" data-num="5" data-namecollapse="" data-labelname="">
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
                                        <a href="<?= base_url('app/item_category/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Item Catgories</div>
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
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/item_unit/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Item Units</div>
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
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/storage_location/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Storage Locations</div>
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
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/item/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Items</div>
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
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/item/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Stocks</div>
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
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/item/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Stock Movements</div>
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