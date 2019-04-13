$(document).ready(function(){

	view_data = [];

	load_project_task_data = function() {
		view_data = [];
		showCover("Loading Tasks...");
		$.ajax({
		    type:'get',
		    url:base_url+"app/project_task/get_groups_and_tasks/"+$('#view_project_project_id').val(),
		    data:'',
		    success:function(data){
		    	hideCover();
		    	var json_data = JSON.parse(data);

		    	console.log(json_data);

		    	if(json_data.success)
		    	{
		    		//$('#project_tasks_tab_content').html(data);
		    		//draw_view(json_data.message);
		    		view_data =json_data.message;
		    		$('#tasks_ul').html('');
		    		setup_views();
		    	}
		    	else
		    	{
		    		sys_toast_error(json_data.message);
		    	}
		    },
		    error: function(error){
		    	hideCover();
		    	sys_toast_error(error.responseText);
		    }
		});

	}


	$('#project_tasks_tab_btn').click(function(e){
		load_project_task_data();
	});


	load_project_task_data();


	function setup_views()
	{
		//load groups view
		for(var a=0; a<view_data.task_groups.length; a++)
		{
			var view = "";
			if(has_child(view_data,view_data.task_groups[a].id))
			{
				view = "<li id='task_group_"+view_data.task_groups[a].id+"'>"+
							"<div>"+
								"<small class='pull-right'>"+
									"[ "+
										"<small id='"+view_data.task_groups[a].id+"' class='point hover-green add-group'>Add Group</small> | "+
										"<small id='"+view_data.task_groups[a].id+"' class='point hover-green add-task'>Add Task</small> | "+
										"<small id='"+view_data.task_groups[a].id_en+"' class='point hover-green edit-group'>Edit</small> "+
									"] "+
								"</small>"+
							"</div>"+
							"<div class='caret'>"+
								"<span>"+
									view_data.task_groups[a].name+
								"</span>"+
							"</div>"+
							"<ul id='task_group_nested"+view_data.task_groups[a].id+"' class='nested'>"+
							"</ul>"+
						"</li>";
			}
			else
			{
				view = "<li id='task_group_"+view_data.task_groups[a].id+"'>"+
							"<div>"+
								"<small class='pull-right'>"+
									"[ "+
										"<small id='"+view_data.task_groups[a].id+"' class='point hover-green add-group'>Add Group</small> | "+
										"<small id='"+view_data.task_groups[a].id+"' class='point hover-green add-task'>Add Task</small> | "+
										"<small id='"+view_data.task_groups[a].id_en+"' class='point hover-green edit-group'>Edit</small> | "+
										"<small id='"+view_data.task_groups[a].id_en+"' class='point hover-green delete-group'>Delete</small> "+
									"] "+
								"</small>"+
							"</div>"+
							"<div class='caret caret-down'>"+
								"<span>"+
									view_data.task_groups[a].name+
								"</span>"+
							"</div>"+
						"</li>";
			}

			view_data.task_groups[a].view = view;
		}

		//load tasks view

		for(var a=0; a<view_data.tasks.length; a++)
		{
			view_data.tasks[a].view =	"<li id='task_"+view_data.tasks[a].id+"'>"+
											"<a target='_blank' href='"+base_url+"app/project_task/view_task/"+view_data.tasks[a].id_en+"'>"+
												view_data.tasks[a].name+
											"</a> &nbsp; <span class='status-indicator' style='background-color:"+view_data.tasks[a].color_code+"'>"+view_data.tasks[a].status_name+"</span>"+
											" &nbsp; <span class='status-indicator' style='background-color:"+view_data.tasks[a].priority_color_code+"'>"+view_data.tasks[a].priority+"</span>"+
										"</li>";
		}

		draw_task_tree();
	}

	function draw_task_tree()
	{
		for(var a=0; a<view_data.task_groups.length; a++)
		{

			if(view_data.task_groups[a].parent_group=='0')
			{
				$('#tasks_ul').append(view_data.task_groups[a].view);
			}
			else
			{
				var parent_id = "#task_group_nested"+view_data.task_groups[a].parent_group;

				$(parent_id).append(view_data.task_groups[a].view);
			}
		}

		for(var a=0; a<view_data.tasks.length; a++)
		{

			if(view_data.tasks[a].project_task_group=='0')
			{
				$('#tasks_ul').append(view_data.tasks[a].view);
			}
			else
			{
				var parent_id = "#task_group_nested"+view_data.tasks[a].project_task_group;

				$(parent_id).append(view_data.tasks[a].view);
			}
		}

		reload_toggler();
	}


	function has_child(data,id)
	{
		var status = false; // assume no child

		var a = 0;

		for(a=0; a<data.task_groups.length; a++)
		{
			if(data.task_groups[a].parent_group == id)
			{
				return true;
			}
		}

		for(a=0; a<data.tasks.length; a++)
		{
			if(data.tasks[a].project_task_group == id)
			{
				return true;
			}
		}

	}



});
