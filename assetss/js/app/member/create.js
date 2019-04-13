$(document).ready(function(){

	project_form_open = function(){
		$('#project_create_modal').modal();
		$('#project_create_form')[0].reset();
	}

	$('#project_create_btn').click(function(){
		project_form_open();
	});


	$('#project_create_form').submit(function(e){
		e.preventDefault();

		showCover("Saving Project...");

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);

		var endpoint = form.data('create_url');

		if($('#project_id').val()!='0')
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
	  				$('#project_create_form')[0].reset();

	  				load_data();
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

	function populate_project_form(json_data)
	{
		$('#project_id').val(json_data.id);
		$('#project_name').val(json_data.name);
		$('#project_description').val(json_data.description);
		$('#project_project_status').val(json_data.project_status);

		$('#project_create_modal').modal();
	}

	$(document).delegate('.project_edit_btn','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);

	        	populate_project_form(json_data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


});