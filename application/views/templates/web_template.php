
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>
    <link href="<?= base_url(); ?>assets/css/web/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/web/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/web/prettyPhoto.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/web/animate.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/web/main.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/rsd.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/public.css">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="<?= base_url(); ?>images/logo.png" alt="logo" style="width:50px;"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= base_url();?>">Home</a></li>
                    <li><a href="<?= base_url();?>/web/about_us">About Us</a></li>
                    <li><a href="<?= base_url();?>/web/Developers">Developers</a></li>
                    <li><a href="<?= base_url();?>web/login">Login</a></li>
                </ul>
            </div>
        </div>
    </header><!--/header-->
    
    <?php $this->load->view('common/cover'); ?>
    <?= $view_data; ?>



    <script src="<?= base_url();?>assets/js/web/jquery.js"></script>
    <script src="<?= base_url();?>assets/js/web/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/web/jquery.prettyPhoto.js"></script>

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
    <!--<script src="<?= base_url();?>assets/js/web/main.js"></script>-->
</body>
</html>