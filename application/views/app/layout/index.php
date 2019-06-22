<div class="content-inner" id="pageActive" data-namecollapse="" data-labelname="">
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
                                        <a href="<?= base_url('app/layout/form/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Form</div>
                                                <small class="card-text text-black-50">Form Layout</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?>
                        <!-- <?php
                            if($this->loginstate->get_access()['overall_access'] == 1)
                            {
                                ?>
                                    <div class="col-md-6">
                                        <a href="<?= base_url('app/layout/stepwizard/'); ?>" class="w-100">
                                            <div class="card card-option card-hover white p-3 mb-3 w-100">
                                                <div class="option-check"><i class="fa fa-hand-o-right fa-lg"></i></div>
                                                <div class="card-header-title font-weight-bold">Step Wizard</div>
                                                <small class="card-text text-black-50">Step Wizard Layout</small>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                            }
                        ?> -->



                    </div>
                </div>
            </div>
</div>