$(document).ready(function(){


	$('#project_group_create_btn').click(function(){
		$('#project_task_group_create_modal').modal();
		$('#project_task_group_create_form')[0].reset();

		$('#project_group_parent_group').val('0');
		$('#project_task_group_id').val('0');
	});


	$('#project_task_group_create_form').submit(function(e){
		
		e.preventDefault();

		showCover("Saving group...");

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);
		form_data.append('project_id',$('#view_project_project_id').val());

		var endpoint = form.data('create_url');

		if($('#project_task_group_id').val()!='0')
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
	  				$('#project_group_name').val('');

	  				load_project_task_data();


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
		$('#project_category').val(json_data.category);
		$('#project_priority').val(json_data.priority_id);

		$('#project_create_modal').modal();
	}

	$(document).delegate('.add-group','click',function(e){
		$('#project_task_group_create_modal').modal();
		$('#project_task_group_create_form')[0].reset();

		$('#project_group_parent_group').val(e.currentTarget.id);
		$('#project_task_task_id').val('0');
	});


	$(document).delegate('.edit-group','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_task_group/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);

	        	$('#project_task_group_create_modal').modal();
				$('#project_task_group_create_form')[0].reset();

				$('#project_group_parent_group').val(json_data.parent_group);
				$('#project_group_name').val(json_data.name);
				$('#project_task_group_id').val(json_data.id);

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });

	});


	$(document).delegate('.delete-group','click',function(e){

		var id = e.currentTarget.id;

		alertify.confirm("Confirmation",'are you sure you want to delete this record?',
			function(){
				showCover('Deleting data...');
				$.ajax({
			        type:'get',
			        url:base_url+'app/project_task_group/delete/'+id,
			        data:'',
			        success:function(data){
			        	hideCover();
			        	var json_data = JSON.parse(data);

			        	if(json_data.success)
			        	{
			        		sys_toast_success(json_data.message);
			        		load_project_task_data();
			        	}
			        	else
			        	{
			        		sys_toast_warning(json_data.message);
			        	}
			        },
			        error: function(error){
			        	hideCover();
			        	sys_toast_error(error.responseText);
			        }
			    });
			},
			function(){
			}
		);

	});
	

});