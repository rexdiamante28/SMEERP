$(document).ready(function(){


	function save_password(form)
	{
		postdata = new FormData(form[0]);

		showCover("Updating password");

		$.ajax({				
				url: form.attr("action"),
		       	type: form.attr("method"),
				data: postdata,
				contentType: false,   
				cache: false,      
				processData:false,
			success : function(data){
					json_data = JSON.parse(data);
					sys_log(json_data);

					if(json_data.success == true)
					{
						$('#change_user_password_form')[0].reset();
						$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
						sys_toast_success(json_data.message);
					}
					else
					{
						sys_toast_warning_info(json_data.message);
						$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
					}
					
					hideCover();

			},
			error : function(error){
				sys_toast_error(error.responseText);
			}
		});
	}


	$('#change_user_password_form').submit(function(e){
		e.preventDefault();
		save_password($(this));
	});

});
