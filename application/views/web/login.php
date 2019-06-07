<div class="centerDiv login">
	<?php 
		$attributes = array('id'=>'login-form');
		echo form_open_multipart('users/authenticate',$attributes);
	?>	
		<div class="form-group" id="login-message">
				
		</div>
		<div class="form-group">
			<label>Username</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" name="username" id="username" placeholder="Username" class="form-control"></input>
			</div>
		</div>
		<div class="form-group">
			<label>Password</label>
			<div class="input-group">
				<span class = "input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" name="password" id="password" placeholder="Password" class="form-control"></input>
			</div>
		</div>
		<div class="form-group">
			<label>
				<input type="checkbox" name="remember" id="remember"></input>
				Remember me
			</label>
			<a class="pull-right" href="">Forgot Password</a>
		</div>
		<div class="form-group">
			<button class="btn btn-primary submit">Log In</button>
		</div>
	</form>
</div>	