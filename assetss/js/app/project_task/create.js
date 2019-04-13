$(document).ready(function(){

	$('#project_task_create_form').submit(function(e){
		
		e.preventDefault();

		showCover("Saving task...");

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);
		form_data.append('project_id',$('#view_project_project_id').val());

		var endpoint = form.data('create_url');

		if($('#project_task_task_id').val()!='0')
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

	  				$('#project_task_task_name').val('');
	  				$('#project_task_description').val('');

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


	$(document).delegate('.add-task','click',function(e){
		$('#project_task_create_modal').modal();
		$('#project_task_create_form')[0].reset();

		$('#project_task_task_group').val(e.currentTarget.id);
		$('#project_task_task_id').val('0');
	});

	window.pell.init({
      element: document.getElementById('editor'),
      defaultParagraphSeparator: 'p',
      onChange: function (html) {
      	$('#project_task_description').val(html);
        //document.getElementById('text-output').innerHTML = html
        //document.getElementById('project_task_description').textContent = html
      }
    });

});