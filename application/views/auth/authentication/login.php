<div class="login-container col-md-8">
	<div class="page-container col-12 login">
		<!-- <div class="logo text-center col-lg-4 col-6">
			<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
		</div> -->
		<div class="row">
			<div class="col-lg-6 col-12 content-container left">
				<div class="content w-100 left-logo">
					<br/>
					<div class="col-12">
						<img class="w-100" src="<?=base_url('assets/img/cplogo.svg'); ?>">
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
                            <div class="form-group">
        					   <a href="" data-toggle="modal" data-target="#forgotpassword" class="text-right">Forgot Password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-1">Sign In</button>
                        </fieldset>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>
	<div id="forgotpassword" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-md">
            <div class="modal-content">
                    <?php
                        $url = base_url('auth/authentication/reset_password');
                        echo form_open($url,array('id'=>'resetpassword_form','method'=>'post'));
                     ?>
                    <div class="modal-header">
                        <div class="col-md-12">
                            <h4 class="modal-title">Forgot Password</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Enter your email so we can send you your new password</label>
                                <input type="text" name="user_email" id="user_email" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit"  class="btn btn-primary waves-effect waves-light">
                                <i class="fa fa-save"></i>
                                <span>Reset Password</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
