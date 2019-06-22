<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="czZlUU1Gb3BPQnBmTXdYNms4bUhGdz09">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($title) ? $title : 'Paypanda'; ?></title>
    <meta name="description" content="">
    <meta name="robots" content="all,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url();?>assets/img/logo-panda.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/style.blue.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/parsley.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/jquery.toast.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/mdb.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/style.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/custom.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/select2-materialize.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/select2.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/datatables.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/admin/css/bootstrap-datepicker3.min.css"></head>
    <!-- <link href="<?=base_url('assets/css/stepwizard/smart_wizard.css'); ?>" rel="stylesheet"> -->
    <link href="<?=base_url('assets/css/stepwizard/smart_wizard_theme_circles.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/admin/css/dropzone.css'); ?>">
    <link href="<?=base_url('assets/css/stepwizard/stepwizard.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/pell.css'); ?>">

    <!-- CSS file -->
    <link rel="stylesheet" href="<?=base_url('assets/css/app/easy-autocomplete.css'); ?>"> 

    <!-- Additional CSS Themes file - not required-->
    <link rel="stylesheet" href="<?=base_url('assets/css/app/easy-autocomplete.themes.min.css'); ?>"> 
    <?php
        if(isset($add_css))
        {
            foreach ($add_css as $value)
            {
                ?>
                    <link href="<?= base_url() ?><?= $value?>" rel="stylesheet">
                <?php
            }
        }
    ?>
    
    <body id="template_body" data-base_url="<?= base_url(); ?>" data-token_name="<?= $this->security->get_csrf_token_name(); ?>" data-token_value="<?= $this->security->get_csrf_hash(); ?>">
        <?php $this->load->view('includes/cover'); ?>
        <div id="sideOverlay"></div>
        <div class="page charts-page">
            <header class="header">
                <nav class="navbar" style="z-index: 1000 !important;">
                    <div class="container-fluid">
                        <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
                            <div class="navbar-header">
                                <a href="#" id="menu-toggle" class="d-inline d-xl-none menu-toggle"><i class="fa fa-bars fa-lg mr-2"></i></a>
                                <a href="<?= base_url(); ?>app/dashboard/" class="navbar-brand">
                                    <div class="brand-text brand-big d-none m-l-sm">
                                        <!-- <img src="<?= base_url();?>assets/img/cplogo.svg" height="20px"> -->
                                        <h3 class="font-weight-bold mb-0">WELCOME TO THE DASHBOARD</h3>
                                    </div>
                                    <div class="brand-text brand-small">
                                        <!-- <img src="<?= base_url();?>assets/img/cplogo.svg" class="img-small_panda"> -->
                                        <strong>SMEERP</strong>
                                    </div>
                                </a>
                            </div>
                                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                                    <li class="nav-item"><a href="<?= base_url(); ?>/auth/authentication/signout" class="nav-link logout small"><i class="fa fa-sign-out fa-2x"></i></a></li>
                                </ul>
                        </div>
                    </div>
                </nav>
            </header>
                <div class="page-content d-flex align-items-stretch"> 
                    <nav id="sideNav" class="side-navbar sidebar-fixed position-fixed">
                        <i class="fa fa-times fa-lg menu-toggle close-icon d-xl-none" aria-hidden="true"></i>
                        <div class="sidebar-header d-flex">
                            <div class="avatar d-flex align-items-center justify-content-center">
                                <!-- <img src="<?= base_url();?>assets/uploads/avatars/<?= $this->session->avatar; ?>" alt="..." class="img-fluid rounded-circle"> -->
                                <h1 class="user-first-letter"><?= substr($this->session->username, 0, 1) ?></h1>
                            </div>
                            <div class="title">
                                <h1 class="h4">Logged in as: </h1>
                                <p title="<?= $this->session->username; ?>"><?= strlen($this->session->username)>20 ? substr($this->session->username, 0, 17).'...': $this->session->username; ?></p>
                            </div>
                        </div>
                        <!-- <div class="side-footer">
                            <div class="border-top-gray" id="searchRN">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form id="searchRN_form" method="POST">
                                            <div class="input-group">
                                                <input type="text" name="refNo" class="form-control form-control-sm capitalize" placeholder="Reference No." id="refNo">
                                                <button class="input-group-btn btn btn-primary btn-auto no-margin" type="submit" id="searchRN">
                                                    <i class="fa fa-search no-margin"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <span class="heading">Main</span>
                        <ul class="list-unstyled pageNavigation">
                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="1"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/home/'); ?>">
                                                <i class="fa fa-home"></i>Home
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="2"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/general/'); ?>">
                                                <i class="fa fa-list"></i>General
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="3"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/account/'); ?>">
                                                <i class="fa fa-users"></i>Account
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="4"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/sales/'); ?>">
                                                <i class="fa fa-calculator"></i>Sales
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="5"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/inventory/'); ?>">
                                                <i class="fa fa-clipboard"></i>Inventory
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="6"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('app/procurement/'); ?>">
                                                <i class="fa fa-tags"></i>Procurement
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                        </ul>
                        <span class="heading">Misc.</span>
                        <ul class="list-unstyled pageNavigation">
                            <?php
                                if($this->loginstate->get_access()['overall_access']==1)
                                {
                                    ?>
                                        <li data-num="7"> 
                                            <a class="list-group-item list-group-item-action waves-effect" href="<?= base_url('sys/settings/'); ?>">
                                            <i class="fa fa-wrench"></i>Settings
                                            </a>
                                        </li>
                                    <?php
                                }
                            ?>

                        </ul>
                    </nav>
                </div>

                <main>
                    <?= $view;?>
                </main>


                <!-- Page Footer-->
                <!-- <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p> Christmas Panda &copy; 2018</p>
                            </div>
                            <div class="col-sm-6">
                                <p>Powered by <a href='http://www.cloudpanda.ph/' class='external' style='text-decoration:underline;'>Cloud Panda PH</a></p>
                            </div>
                        </div>
                    </div>
                </footer> -->


                <?php
    
                    if(isset($forms))
                    {
                        foreach ($forms as $form) {
                            echo $form;
                        }
                    }

                ?>

        </div>

        <!-- Javascript files-->
        <script src="<?= base_url();?>assets/admin/js/jquery.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/tether.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/jquery.cookie.js"> </script>
        <script src="<?= base_url();?>assets/admin/js/jquery.validate.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/front.js"></script>
        <script src="<?= base_url();?>assets/admin/js/jquery.toast.js"></script>
        <script src="<?= base_url();?>assets/admin/js/select2.js"></script>
        <script src="<?= base_url();?>assets/admin/js/parsley.js"></script>
        <script src="<?= base_url();?>assets/admin/js/parsley.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/jquery.mask.js"></script>
        <script src="<?= base_url();?>assets/admin/js/loadingoverlay.js"></script>
        <script src="<?= base_url();?>assets/admin/js/mdb.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/jquery-ui.js"></script>
        <script src="<?= base_url();?>assets/admin/js/datatables.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/select2.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/bootstrap-datepicker.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/accounting.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/moment.js"></script>
        <script src="<?= base_url();?>assets/admin/js/custom.js"></script>
        <script src="<?= base_url();?>assets/admin/js/mdb.min.js"></script>
        <script src="<?= base_url();?>assets/admin/js/dropzone.js"></script>
        <script src="<?= base_url();?>assets/js/public.js"></script>
        <script src="<?= base_url() ?>assets/js/alertify.js"></script>
        <script src="<?= base_url() ?>assets/js/pell.js"></script>
        <script src="<?=base_url('assets/js/stepwizard/jquery.smartWizard.js'); ?>"></script>
        <script src="<?=base_url('assets/js/stepwizard/stepwizard.js'); ?>"></script>

        <!-- CSS file -->
        <script type="text/javascript" src="<?=base_url('assets/js/app/jquery.easy-autocomplete.js'); ?>" ></script>

        <?php
            if(isset($add_js))
            {
                foreach ($add_js as $value) {
                    ?>
                        <script type="text/javascript" src="<?=base_url().$value;?>"></script>
                    <?php
                }
            }
        ?>

    </body>
    </html>