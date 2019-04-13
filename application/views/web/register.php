
<div class="page-container col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12 home">
	<div class="logo text-center col-6">
		<img class="w-100" src="<?=base_url("assets/img/logo-2.png") ?>">
	</div>

	<h3 class="title text-center">Registration Form</h3>
	<?php
		$url = base_url('app/payer/register');
		echo form_open($url,array('id'=>'registration_form','method'=>'post'));
	?>
		<fieldset>
			<div class="row">
				<div class="col-12">
					<div class="content">
						<div class="row">
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">First Name</label>
								<input type="text" class="form-control" placeholder="" name="first_name">
							</div>
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Middle Name</label>
								<input type="text" class="form-control" placeholder="" name="middle_name">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Last Name</label>
								<input type="text" class="form-control" placeholder="" name="last_name">
							</div>
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Contact Number</label>
								<input type="text" class="form-control" placeholder="" name="contact_number">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Gender</label>
								<select type="text" class="form-control" placeholder="" name="gender">
									<option value="">-- Select one --</option>
									<option value="1">Male</option>
									<option value="2">Female</option>
								</select>
							</div>
							<div class="form-group col-md-6 col-12">
								<label for="exampleInputEmail1">Birth Date</label>
								<input type="date" class="form-control" placeholder="" name="birth_date">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<label for="exampleInputEmail1">Email Address</label>
								<input type="email" class="form-control" placeholder="" name="email">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<label for="exampleInputEmail1">Password</label>
								<input type="password" class="form-control" placeholder="" name="password">
							</div>
						</div>

						<div class="row">
							<div class="form-group col-12">
								<label for="exampleInputEmail1">Confirm Password</label>
								<input type="password" class="form-control" placeholder="" name="password2">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<label for="exampleInputEmail1">Home Address</label>
								<textarea type="text" class="form-control" placeholder="" name="address"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12" id="captcha_div">
								
							</div>
						</div>
						<div class="row">
							<div class="form-group col-12">
								<button type="submit" class="btn btn-primary btn-block">Sign Up</button>
							</div>
						</div>
						<label class="register-link">Already registered? <a href="<?=base_url('main/login'); ?>">Sign in here</a>.</label>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
</div>
