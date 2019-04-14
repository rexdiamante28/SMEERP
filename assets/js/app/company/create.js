$(document).ready(function(){

	$('#company_form').submit(function(e){

		showCover("Saving...");

		e.preventDefault();

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);

		$.ajax({
	  		type: form[0].method,
	  		url: form[0].action,
	  		data: form_data,
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			update_token(json_data.csrf_hash);

	  			if(json_data.success)
	  			{
	  				sys_toast_success(json_data.message);
	  				if($('#primary').val()!=json_data.id)
	  				{
						window.location = base_url+'app/company/view/'+json_data.id;
	  				}
	  				
	  			}
	  			else
	  			{
	  				sys_toast_warning(json_data.message);
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});

	});

});
