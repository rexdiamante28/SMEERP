$(document).ready(function(){

	load_project_details = function()
	{
		showCover('Loading project details...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project/project_details_partial_view/'+$('#view_project_project_id').val(),
	        data:'',
	        success:function(data){
	        	hideCover();
	        	$('#project_details_partial_view_location').html(data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}

	load_project_details();

	load_project_tasks = function()
	{
		showCover('Loading project tasks...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_task/list/'+$('#view_project_project_id').val(),
	        data:'',
	        success:function(data){
	        	hideCover();
	        	$('#project_details_partial_view_location').html(data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}


	load_project_logs = function()
	{
		showCover('Loading project logs...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/project_log/list/'+$('#view_project_project_id').val(),
	        data:'',
	        success:function(data){
	        	hideCover();
	        	$('#project_logs_tab_content').html(data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}

	$('#project_logs_tab_btn').click(function(e){
		load_project_logs();
	});


	reload_toggler = function(){
		var toggler = $(".caret");
		var i;

		for (i = 0; i < toggler.length; i++) {
		  toggler[i].addEventListener("click", function() {
		  	if(this.parentElement.querySelector(".nested"))
		  	{
		  		this.parentElement.querySelector(".nested").classList.toggle("active-tree");
		    	this.classList.toggle("caret-down");
		  	}
		    
		  });
		}
	}


	

});