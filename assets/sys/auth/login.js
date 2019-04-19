$(document).ready(function(){

	//initiate login
	function login(form)
	{	
		showCover("Authenticating...");
		var formData = new FormData(form);
		
		$.ajax({
	  		type: 'post',
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
	  				sys_toast_warning_info(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				sys_toast_success(json_data.message);
	  				window.location = json_data.url;
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  			hideCover();
	  		}
	  	});
	}

	function resetPassword(form){

		showCover("Please wait...");
		
		var formData = new FormData(form);
		
		$.ajax({
	  		type: 'post',
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
	  				sys_toast_warning_info(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				sys_toast_success(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  				$("#forgotpassword").modal('toggle');
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  			hideCover();
	  		}
	  	});
	}


	$('#login_form').submit(function(e){
		e.preventDefault();
		login($(this)[0]);
	});	

	$('#resetpassword_form').submit(function(e){
		e.preventDefault();
		resetPassword($(this)[0]);
	});


});