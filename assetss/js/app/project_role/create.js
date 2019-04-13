$(document).ready(function(){

	$('#project_role_create_form').submit(function(e){
		
		e.preventDefault();

		showCover("Saving Role...");

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);
		form_data.append('project_id',$('#view_project_project_id').val());

		var endpoint = form.data('create_url');

		if($('#project_role_id').val()!='0')
		{
			endpoint = form.data('update_url');
		}

		$.ajax({
	  		type: form[0].method,
	  		url: endpoint,
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

	  				$('#project_role_create_form')[0].reset();
	  				load_project_role_data();
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


	$('#project_role_create_btn').click(function(){
		$('#project_role_create_modal').modal();
		$('#project_role_create_form')[0].reset();
	});


	$(document).delegate('.project_role_edit_btn','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_role/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	console.log(json_data);

	        	$('#project_role_create_form')[0].reset();

				$('#project_role_id').val(json_data.id_en);
				$('#project_role').val(json_data.role);

				$('#project_role_create_modal').modal();
				

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});



});