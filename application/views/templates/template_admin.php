<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?= isset($title) ? $title : 'SMERP'; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Merriweather:900" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link href="<?=base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/step-wizard.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/custom.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/adminstyle.css'); ?>">
	<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/favicon.ico'); ?>"/>

	<link rel="stylesheet" href="<?= base_url();?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url();?>assets/css/jquery.toast.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/alertify.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/pell.css'); ?>">

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

</head>
<body <body id="template_body" data-base_url="<?= base_url(); ?>" data-token_name="<?= $this->security->get_csrf_token_name(); ?>" data-token_value="<?= $this->security->get_csrf_hash(); ?>">
	<!-- <div class="sidebar-overlay"></div> -->
	<?php $this->load->view('includes/cover'); ?>
	<header class="d-flex align-items-center">
		<i class="fas fa-bars mr-3 header-icon sidebar-toggler d-lg-none"></i>
		<!-- <div class="sidebar-toggler d-lg-none">hello</div> -->
		<!-- <span class="text-uppercase font-weight-bold d-none d-lg-inline">Welcome to the Partner Dashboard</span> -->
		<div class="ml-auto h-100">
			<span class="mx-3 header-divider">|</span>
			<div class="dropdown show d-inline h-100 ">
				<a class="profile-menu" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img class="h-100 mr-3 partner-logo-img d-none d-lg-inline" src="<?=base_url("assets/img/krispykremelogo.png") ?>" alt="">
					<span class="d-none d-lg-inline">Krispy Kreme</span>
					<i class="fas fa-user header-icon ml-1 mr-2 d-inline d-lg-none primary-color"></i>
					<span class="d-none d-lg-inline">
						<i class="fas fa-chevron-down header-icon ml-1 mr-2"></i>
					</span>
				</a>

				<div class="dropdown-menu py-0" aria-labelledby="dropdownMenuLink">
					<a class="dropdown-item" href="<?=base_url("main/profile")?>"><i class="fas fa-user mr-3"></i>Profile</a>
					<a class="dropdown-item" href="<?= base_url('auth/authentication/signout'); ?>"><i class="fas fa-sign-out-alt mr-3"></i>Logout</a>
				</div>
			</div>
		</div>
	</header>
	<aside class="p-0">
		<div class="sidebar-header d-flex align-items-center">
			<img class="h-100 mr-3" src="<?=base_url("assets/img/Hit Me Logo white 2.png") ?>" alt="">
			<span class="text-uppercase text-white font-weight-bold">Partner Dashboard</span>
		</div>
		<div class="sidebar-menu">
			<div class="list-group list-group-flush">
				<a href="<?=base_url('app/home/'); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="1"><i class="fas fa-home mr-3"></i>Home</a>
				<a href="<?=base_url(); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="2"><i class="fas fa-newspaper mr-3"></i>Account</a>
				<a href="<?=base_url('app/general/'); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="3"><i class="fas fa-coins mr-3"></i>General</a>
				<a href="<?=base_url('main/settings'); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="4"><i class="fas fa-tasks mr-3"></i>Inventory</a>
				<a href="<?=base_url('main/settings'); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="5"><i class="fas fa-tasks mr-3"></i>Sales</a>
				<a href="<?=base_url('main/settings'); ?>" class="list-group-item list-group-item-action sidebar-item" data-num="6"><i class="fas fa-tasks mr-3"></i>Procurement</a>
			</div>
		</div>
	</aside>
	<main>
		<?= $view;?>
	</main>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/jquery.steps.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/datatables.js'); ?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/script.js'); ?>"></script>
<script src="<?= base_url();?>assets/js/select2.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap-datepicker.min.js"></script>

<script src="<?= base_url();?>assets/js/jquery.toast.js"></script>
<script src="<?= base_url();?>assets/js/moment.js"></script>
<script src="<?= base_url();?>assets/js/custom.js"></script>
<script src="<?= base_url();?>assets/js/public.js"></script>
<script src="<?= base_url() ?>assets/js/alertify.js"></script>
<script src="<?= base_url() ?>assets/js/pell.js"></script>

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
