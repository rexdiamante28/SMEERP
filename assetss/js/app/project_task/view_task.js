$(document).ready(function(){

	load_tasks_logs = function()
	{
		showCover('Loading project tasks...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_task_log/list/'+$('#view_project_task_task_id').val(),
	        data:'',
	        success:function(data){
	        	hideCover();
	        	$('#project_task_logs_container').html(data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}

	load_tasks_logs();


	$('#update_project_task_btn').click(function(e){

		showCover('Loading task details...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_task/read/'+$('#view_project_task_task_id').val(),
	        data:'',
	        success:function(data){
	        	hideCover();
	        	json_data = JSON.parse(data);

	        	$('#project_task_task_id').val($('#view_project_task_task_id').val());
				$('#project_task_task_group').val(json_data.project_task_group);
				$('#project_task_task_name').val(json_data.name);
				$('#project_task_description').val(json_data.description);
				$('.pell-content').html(json_data.description);
				$('#project_priority').val(json_data.priority_id);
				$('#project_task_man_hours').val(json_data.man_hours);
				$('#project_task_weight').val(json_data.weight);
				$('#project_task_status').val(json_data.task_status_id);
				$('#project_task_start_date').val(json_data.target_start_date);
				$('#project_task_deadline').val(json_data.deadline);


				showCover('Loading task details...');
				$.ajax({
			        type:'get',
			        url:base_url+'app/project_task/get_assignees/'+$('#view_project_task_task_id').val(),
			        data:'',
			        success:function(data){
			        	hideCover();
			        	json_data = JSON.parse(data);

			        	console.log(JSON.parse(data));

			        	$('#project_task_assignee').val(json_data);

			        	$('#project_task_create_modal').modal();

			        },
			        error: function(error){
			        	hideCover();
			        	sys_toast_error(error.responseText);
			        }
			    });
				

	        	console.log(JSON.parse(data));
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });

		/*$('#project_task_create_form')[0].reset();

		$('#project_task_task_group').val('0');
		$('#project_task_task_id').val('0');*/
	});

});