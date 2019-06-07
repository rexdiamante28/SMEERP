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
    <link href="<?= base_url() ?>assets/css/custom.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/alertify.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/default.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/semantic.min.css" rel="stylesheet">

    <link href="<?= base_url() ?>assets/css/rsd.css" rel="stylesheet">

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
<body class="nav-md">
	<div class="container body">
		<?php $this->load->view('common/cover'); ?>
		<div class="main_container">
			<div class="col-md-3 left_col">
	          <div class="left_col scroll-view">
	            <div class="navbar nav_title" style="border: 0;">
	              <a href="index.html" class="site_title"><i class="fa fa-cogs"></i> <span><?= company_name(); ?></span></a>
	              <!-- <label style="margin-right:10px;" class="pull-right">Auto Parts Shop</label> -->
	            </div>

	            <div class="clearfix"></div>

	            <!-- menu profile quick info -->
	            <div class="profile clearfix">
	              <div class="profile_pic">
	                <img src="<?=base_url();?>assets/images/avatar/<?= $this->session->avatar; ?>" alt="..." class="img-circle profile_img">
	              </div>
	              <div class="profile_info">
	                <span>Welcome,</span>
	                <h2><?= ucwords($this->session->first_name.' '.substr($this->session->middle_name, 0, 1).'. '.$this->session->last_name) ?></h2>
	              </div>
	              <div class="clearfix"></div>
	            </div>
	            <!-- /menu profile quick info -->
	            <br />

	            <!-- sidebar menu -->
	            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	              <div class="menu_section">
	                <h3>General</h3>
	                <ul class="nav side-menu">
	                  <?php
	                  		if ((strpos($this->session->functions, 'Notification Sales') !== false) || (strpos($this->session->functions, 'Notification Inventory') !== false) || (strpos($this->session->functions, 'Notification Users') !== false) || (strpos($this->session->functions, 'Notification Items') !== false)) 
	                  		{
	                  			?>
	                  				<li><a href="<?= base_url() ;?>notifications/"><i class="fa fa-dashboard"></i> Notifications </a></li>
	                  			<?php
							}
	                  ?>
	                  <?php
	                  		if (strpos($this->session->functions, 'Sell Items') !== false) 
	                  		{
	                  			?>
	                  				<li><a><i class="fa fa-money"></i> Sales <span class="fa fa-chevron-down"></span></a>
	                  				  <ul class="nav child_menu">
	                  				    <li><a href="<?= base_url() ?>transactions/">Transactions</a></li>
	                  				  </ul>
	                  				</li>
	                  			<?php
							}
	                  ?>
	                  <?php
		                  	if (strpos($this->session->functions, 'Manage Stocks') !== false) 
		                  	{
		                  		?>
		                  		  <li><a><i class="fa fa-clipboard"></i> Inventory <span class="fa fa-chevron-down"></span></a>
		                  		    <ul class="nav child_menu">
		                  		      <li><a href="<?= base_url() ?>stocks/">Stocks</a></li>
		                  		      <li><a href="<?= base_url() ?>itemmovements/">Stock Movement</a></li>
		                  		    </ul>
		                  		  </li>
		                  		<?php
							}
		               ?>
	                  
	                </ul>
	              </div>
	              <div class="menu_section">
	                <h3>ADMININSTRATION</h3>
	                <ul class="nav side-menu">

	                  <?php
	                  		if ((strpos($this->session->functions, 'Manage Branches') !== false) || (strpos($this->session->functions, 'Manage Locations') !== false) || (strpos($this->session->functions, 'Manage Items') !== false)) 
	                  		{
	                  			?>
	                  				<li><a><i class="fa fa-home"></i> Company <span class="fa fa-chevron-down"></span></a>
		                    		   <ul class="nav child_menu">
		                    		     <?php
			                		     		if (strpos($this->session->functions, 'Manage Branches') !== false) 
			                		     		{
			                		     			?>
			                		     			  <li><a href="<?= base_url() ?>branches/">Branches</a></li>
			                		     			<?php
									   		}
			                		     ?>
			                		     
			                		     <?php
			                		     		if (strpos($this->session->functions, 'Manage Locations') !== false) 
			                		     		{
			                		     			?>
			                		     			  <li><a href="<?= base_url() ?>storagelocations/">Storage Locations</a></li>
			                		     			<?php
									   		}
			                		     ?>
			                		     <?php
			                		     		if (strpos($this->session->functions, 'Manage Items') !== false) 
			                		     		{
			                		     			?>
			                		     			  <li><a>Items<span class="fa fa-chevron-down"></span></a>
			                		        		     <ul class="nav child_menu">
			                		        		       <li class="sub_menu"><a href="<?= base_url() ?>itemcategories/">Item Categories</a>
			                		        		       </li>
			                		        		       <li><a href="<?= base_url() ?>items/">Items</a>
			                		        		       </li>
			                		        		       <!--<li><a href="#level2_2">Item Kits</a>-->
			                		        		       </li>
			                		        		       <li><a href="<?= base_url() ?>itemunits/">Item Units</a>
			                		        		       </li>
			                		        		     </ul>
			                		        		   </li>
			                		     			<?php
									   		}
			                		     ?>
		                    		   </ul>
		                  		     </li>
	                  			<?php
							}
	                  ?>
	                  
	                  <!--<li><a href="<?= base_url() ?>pos/"><i class="fa fa-laptop"></i> POS </a></li>-->
	                  <?php
	                  		if (strpos($this->session->functions, 'Sell Items') !== false) 
	                  		{
	                  			?>
	                  			  <li><a><i class="fa fa-laptop"></i> POS <span class="fa fa-chevron-down"></span></a>
		                  		     <ul class="nav child_menu">
		                  		       <li><a href="<?= base_url() ?>terminals/">Terminals</a></li>
		                  		     </ul>
		                  		   </li>
	                  			<?php
							}
	                  ?>
	                  <?php
	                  		if (strpos($this->session->functions, 'Manage Users') !== false) 
	                  		{
	                  			?>
	                  				<li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
			                  		  <ul class="nav child_menu">
			                  		    <li><a href="<?= base_url() ?>users/">Users</a></li>
			                  		  </ul>
			                  		</li>
	                  			<?php
							}
	                  ?>
	                  <!--<li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Taxes </a></li>
	                  <li><a href="<?= base_url() ?>discounts/"><i class="fa fa-laptop"></i> Discounts </a></li>-->
	                </ul>
	              </div>
	              <?php
	                  if (strpos($this->session->functions, 'View Reports') !== false) 
	                  {
	                  	  ?>
	                  	  <div class="menu_section">
	                        <h3>REPORTS</h3>
	                        <ul class="nav side-menu">
	                          <li><a href="<?= base_url() ;?>page/reports/"><i class="fa fa-dashboard"></i> Reports </a></li>
	                        </ul>
	                      </div>
	                  	  <?php
					  }
	              ?>
	              
	            </div>
	            <!-- /sidebar menu -->

	            <!-- /menu footer buttons -->
	            <!--<div class="sidebar-footer hidden-small">
	              <a data-toggle="tooltip" data-placement="top" title="Settings">
	                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	              </a>
	              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
	                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	              </a>
	              <a data-toggle="tooltip" data-placement="top" title="Lock">
	                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	              </a>
	              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
	                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	              </a>
	            </div>-->
	            <!-- /menu footer buttons -->
	          </div>
	        </div>

	        <!-- top navigation -->
	        <div class="top_nav">
	          <div class="nav_menu">
	            <nav>
	              <div class="nav toggle">
	                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
	              </div>

	              <ul class="nav navbar-nav navbar-right">
	                <li class="">
	                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                    <img src="<?=base_url();?>assets/images/avatar/<?= $this->session->avatar; ?>" alt="">
	                    <?= ucwords($this->session->first_name.' '.substr($this->session->middle_name, 0, 1).'. '.$this->session->last_name) ?>
	                    <span class=" fa fa-angle-down"></span>
	                  </a>
	                  <ul class="dropdown-menu dropdown-usermenu pull-right">
	                    <li><a data-toggle="modal" data-target="#change_password_modal"> Change Password</a></li>
	                    <li><a href="<?= base_url().'users/logout/'?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
	                  </ul>
	                </li>

	                <?php
	                 	if ((strpos($this->session->functions, 'Notification Sales') !== false) || (strpos($this->session->functions, 'Notification Inventory') !== false) || (strpos($this->session->functions, 'Notification Users') !== false) || (strpos($this->session->functions, 'Notification Items') !== false)) 
	                 	{
	                 		?>
	                 			<li role="presentation" class="dropdown">
		                		  <a href="<?= base_url(); ?>/notifications/" class=" info-number"  aria-expanded="false">
		                		    <i class="fa fa-envelope-o"></i>
		                		    	<?php
			            		      		$query="select count(id) as count from notifications where user_id = '".$this->session->user_id."'
			            		      		and checked = '0'";
			            		      		$countnotif = intval($this->notification_model->_custom_query($query)->row()->count);
			            		      		
			            		      		if($countnotif>0)
			            		      		{
			            		      			?>
				        		          			<span class="badge bg-green">
				        		          				<?= $countnotif; ?>
				        		          			</span>
				        		          		<?php
			            		      		}
			            		      	?>
		                		  </a>
		                		</li>
	                 		<?php
						}
	                ?>
	              </ul>
	            </nav>
	          </div>
	        </div>
	        <!-- /top navigation -->


	        <!-- page content -->
	        <div class="right_col" role="main">
	          <div class="">
	            <div class="page-title">
	              <div class="title_left">
	                <div class="col-md-5 col-sm-5 col-xs-12 form-group top-10">
	                  <select type="text" class="form-control" id="record_per_page">
	                    	<option value="5">5</option>
	                    	<option value="10">10</option>
	                    	<option value="20" selected>20</option>
	                    	<option value="50">50</option>
	                    	<option value="100">100</option>
	                    	<option value="200">200</option>
	                    	<option value="500">500</option>
	                    	<option value="1000">1000</option>
	                  </select>
	                </div>
	              </div>

	              <div class="title_right">
	                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	                  <div class="input-group">
	                    <form id="search_form">
	                    	<div class="input-group">
	                    		<input type="text" class="form-control" id="search" placeholder="Search">
			                    <span class="input-group-btn">
			                      <button class="btn btn-default" type="submit">Go!</button>
			                    </span>
	                    	</div>
	                    </form>
	                  </div>
	                </div>
	              </div>
	            </div>

	            <div class="clearfix"></div>

	            <div class="row">
	              <div class="col-md-12 col-sm-12 col-xs-12">
	                <div class="x_panel">
	                  <div class="x_title">
	                    <h2><?= $title ?></h2>
	                    <ul class="nav navbar-right panel_toolbox">
	                      <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
	                      <?php
	                      	if(isset($forms))
	                      	{
	                      		?>
	                      			<li><a id="add_record_trigger" data-target="#add_record_modal" data-toggle="modal"><i class="fa fa-plus"></i> Add Record</a></li>
	                      		<?php
	                      	}
	                      ?>
	                    </ul>
	                    <div class="clearfix"></div>
	                  </div>
	                  <div class="x_content" id="x_content">
	                  	<?= $view_data ?>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	        <!-- /page content -->

	        <!-- footer content -->
	        <footer>
	          <div class="pull-right">
	          </div>
	          <div class="clearfix"></div>
	        </footer>
	        <!-- /footer content -->

	        <!-- modals -->
	        <?php

	        	if(isset($forms))
	        	{
	        	 	foreach ($forms as $value)
	        	 	{
	        	 		echo $value;
	        	 	}
	        	}

	        	$this->load->view('common/change_password_modal');

	       	?>
		</div>
    </div>


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