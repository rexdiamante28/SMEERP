<div class="login-container col-md-8">
	<div class="page-container col-12 login">
		<!-- <div class="logo text-center col-lg-4 col-6">
			<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
		</div> -->
		<div class="row">
			<div class="col-lg-6 col-12 content-container left">
				<div class="content w-100 left-logo">
					<div class="logo-container">
						<img class="w-100" src="<?=base_url('assets/img/logo-1.png'); ?>">
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-12 content-container right">
				<div class="content">
					<?php
						$url = base_url('auth/authentication/login');
					    echo form_open($url,array('id'=>'login_form','method'=>'post'));
					 ?>
						<fieldset>
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" name="username">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" name="password">
							</div>
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</fieldset>
					</form>
					<label class="register-link">Not yet registered? <a href="<?=base_url('main/register'); ?>">Sign up here</a></label>
				</div>
			</div>
		</div>
	</div>
</div>
