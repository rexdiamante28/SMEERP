<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?= $title ?></title>

	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/public.css">
	<!-- Bootstrap -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url() ?>assets/css/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <!--<link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">-->

    <link href="<?= base_url() ?>assets/css/alertify.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/default.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/semantic.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/rsd.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/pos.css" rel="stylesheet">

</head>
<body class="nav-md">
	<div class="container body">
		<?php $this->load->view('common/cover'); ?>
		<div id="main-content">
			<div id="left_pane">
				<div id="top-controls">
					<label><?= $this->session->first_name.' '.$this->session->middle_name.' '.$this->session->last_name?></label>
					<a href="../terminals/" class="pull-right btn btn-sm btn-warning">Close
					</a>
				</div>
				<div id="order_listing">
					<?php $this->load->view('common/loading')?> 
				</div>
				<div id="bottom-controls">
					<button id="payment_trigger" class="pull-right btn btn-block btn-default">Payment</button>
				</div>
			</div>
			<div id="right_pane">
				<div id="top-controls_right">
					<span class="pull-right">
						<form id="search_form">
							<input type="text" name="search" id="search" class="text-center" placeholder="Search item">
						</form>
					</span>
				</div>
				<div id="items_listing">
					<?php $this->load->view('common/loading')?> 
				</div>
			</div>
		</div>
    </div>

    <?php 
    	$this->load->view('account/pos/order_modal');
    	$this->load->view('account/pos/unique_order_modal');
    	$this->load->view('account/pos/payment_modal');
    ?>


	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.1.11.1.js" ></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/public.js" ></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url() ?>assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?= base_url() ?>assets/js/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?= base_url() ?>assets/js/alertify.js"></script>

    <script src="<?= base_url() ?>assets/js/semantic.min.js"></script>

    <script src="<?= base_url() ?>assets/js/custom.js"></script>

    <script src="<?= base_url() ?>assets/js/pos.js"></script>

</body>
</html>