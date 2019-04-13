<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title><?= $view_title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Poiret+One|Baloo|Passion+One" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<!-- <link href="<?=base_url('assets/css/lux.bootstrap.min.css'); ?>" rel="stylesheet"> -->
	<link href="<?=base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css'); ?>"> -->
	<link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/logo-panda.png'); ?>"/>

	<style type="text/css">
		#transparent-cover{
			position: fixed;
			top: 0;
			left: 0;
			height: 100vh;
			width: 100%;
			background-color: rgba(100,100,100,.8);
			z-index: 9999;
			display:table;
		}

		.cover-inside{
			display: table-cell;
			vertical-align: middle;
			text-align: center;
			color: #E3E3E2;
			font-size: 30px;
			font-weight: normal !important;
		}

		#current-activity{
			font-size: 30px;
			font-weight: 100 !important;
			color: white;
		}


		/*first form*/
		#payment_gateway_frame1{
			width: 550px;
			max-width: 550px;
			margin: 10px auto;
		}

		#ppp_header{
			background-color: #FFEBCC;
		}

		#ppp_header1{
			width: 150px;
			height: 100px;
			display: inline-block;
			float: left;
			padding-top: 20px;
			padding-bottom: 20px;
			background-color: #FFEBCC;
			padding-left: 15px;
		}

		#ppp_header1 img{
			width: 130px;
			margin-top: 15px;
		}

		#ppp_header2{
			width: 400px;
			color: #000099;
			padding-top: 20px;
			padding-bottom: 20px;
			background-color: red;
			display: inline-block;
			float: left;
			background-color: #FFEBCC;
			height: 100px;
			padding-left: 15px;
		}

		#ppp_body1_title{
			color: #000099;
		}

		#ppp_body1{
			border-bottom: 1px solid black;
			padding: 10px;
		}

		#ppp_body2 h2{
			color: #000099;
		}

		#ppp_body2 b{
			color: #272822;
			font-size: 15px;
		}

		#ppp_visa, #ppp_mastercard{
			width: 80px;
			cursor: pointer;
		}

		#ppp_visa img, #ppp_mastercard img{
			width: 70px;
		}

		#ppp_body2{
			border-bottom: 2px solid #FFA722;
		}

		#ppp_footer{
			text-align: center;
			color: #BBBBBB;
		}
		/*first form*/


		/*second form*/
		#payment_gateway_frame2{
			width: 550px;
			max-width: 550px;
			margin: 10px auto;
		}

		#ppp_visa1, #ppp_mastercard1{
			width: 80px;
			cursor: pointer;
		}

		#ppp_visa1 img, #ppp_mastercard1 img{
			width: 70px;
		}

		#ppp_header_1{
			background-color: #FFEBCC;
			height: 35px;
			width: 100%;
		}

		#ppp_body_1{
			border-bottom: 2px solid #FFA722;
			padding: 15px;
		}

		#ppp_body2 .row{
			margin-bottom: 5px;
		}

		#ppp_body2 b{
			font-size: 12px;
		}

		.paybtn{
			background-color: #FFEBCC;
			color: #000099;
			border: 2px solid #000099;
			border-radius: 10px;
			padding: 3px 15px;
			font-size: 12px;
		}
		/*second form*/

	</style>

	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.toast.css');?>">
</head>
<body data-base_url="<?=base_url();?>">
	<?php $this->load->view('includes/cover'); ?>
	<main>
		<div class="container">
			<?= $view_data; ?>
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

<?php
	foreach ($add_js as $value) {
		?>
			<script type="text/javascript" src="<?=base_url().$value;?>"></script>
		<?php
	}
?>

<script type="text/javascript">
	function showCover(message){
		$('#current-activity').html(message);
	    $('#transparent-cover').css({'display':'table'});
	}

	function hideCover(){
		$('#current-activity').html('');
	    $('#transparent-cover').css({'display':'none'});
	}

	$(document).ready(function(){
		hideCover();
	});

	function tofixed(x){
		return numberWithCommas(parseFloat(x).toFixed(2));
	}
	function numberWithCommas(x){
	  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

</script>

<script src="<?= base_url('assets/js/jquery.toast.js'); ?>"></script>

</body>
</html>


