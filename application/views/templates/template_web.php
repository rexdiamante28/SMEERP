<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?= $title; ?></title>
	<!-- <link href="https://fonts.googleapis.com/css?family=Poiret+One|Baloo|Passion+One" rel="stylesheet"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link href="<?=base_url('assets/css/lux.bootstrap.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/webstyle.css'); ?>">
	<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/logo-panda.png'); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/app/app.css'); ?>">

	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.toast.css');?>">

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
<body data-base_url="<?=base_url();?>">
	<?php $this->load->view('includes/cover'); ?>
	<main>
		<div class="container">
			<?= $view; ?>
		</div>
	</main>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script
src="https://code.jquery.com/jquery-migrate-3.0.1.min.js"
integrity="sha256-F0O1TmEa4I8N24nY0bya59eP6svWcshqX1uzwaWC4F4="
crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="<?=base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?=base_url('assets/js/public.js'); ?>"></script>

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


<script src="<?= base_url('assets/js/jquery.toast.js'); ?>"></script>


	<div id="message_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
	    <div role="document" class="modal-dialog modal-md">
	        <div class="modal-content">
	            <div class="modal-header" id="message_modal_header"  style="background-color: red;">
	                <div class="col-md-12">
	                    <h4 id="message_modal_label" style="color: white;" class="modal-title"></h4>
	                </div>
	            </div>
	            <div class="modal-body">
	                <div class="col-12">
	                       
	                </div>
	            </div>
	            <div class="modal-footer">
	                <div class="col-md-12 text-right">
	                    <button type="button" class="btn btn-default btn-sm cancelBtn waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</body>
</html>


