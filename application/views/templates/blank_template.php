<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>

	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrapflat.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/account_template.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/rsd.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/public.css">
<?php
	if(isset($add_css))
	{
		foreach ($add_css as $value)
		{
			?>
				<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/<?= $value?>">
			<?php
		}
	}
?>
</head>
<body>
	<!--The actual view file-->
	<?php $this->load->view('common/cover'); ?>
	<?= $view_data ?>


	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.1.11.1.js" ></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap.js" ></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/account_template.js" ></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/public.js" ></script>
	<?php
		if(isset($add_js))
		{
			foreach ($add_js as $value)
			{
				?>
					<script type="text/javascript" src="<?= base_url() ?><?= $value?>" ></script>
				<?php
			}
		}
	?>
</body>
</html>