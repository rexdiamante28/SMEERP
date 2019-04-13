$(document).ready(function(){

	function get_captcha()
	{	
		showCover("loading captcha...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'auth/authentication/generate_captcha',
	  		data: '',
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();
	  			$('#captcha_div').html(json_data.data);
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	get_captcha();

	$(document).delegate("#cp_captcha_id", "click", function(){
	    get_captcha();
	});


	function validate_captcha()
	{

		var formData = new FormData();
		formData.append('captcha_text',$('#cp_captcha_textbox').val());
		formData.append([ajax_token_name],ajax_token);

		showCover("validating captcha...");

		$.ajax({
	  		type: 'post',
	  		url: base_url+'auth/authentication/validate_captcha',
	  		data: formData,
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	function get_token()
	{	
		showCover("loading...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'auth/authentication/get_token',
	  		data: '',
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();
	  			
	  			ajax_token_name = json_data.data.csrf_name;
	  			ajax_token = json_data.data.csrf_hash;
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	get_token();


	function register(form)
	{
		showCover("Processing Registration...");
		var formData = new FormData(form);
		$.ajax({
	  		type: form.method,
	  		url: form.action,
	  		data: formData,
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			if(json_data.success==false)
	  			{
	  				sys_toast_warning(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				//sys_toast_success(json_data.message);
	  				window.location = base_url+"web/registration_success/"+json_data.message;
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	$('#registration_form').submit(function(e){
		e.preventDefault();
		register($(this)[0]);

	});

});