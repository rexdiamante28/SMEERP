$(document).ready(function(){

	//requires #view_project_project_id' text element containing encrypted project id 

	project_log_form_open = function(){
		$('#project_log_create_modal').modal();
		$('#project_log_create_form')[0].reset();
	}

	$('#project_log_create_btn').click(function(){
		project_log_form_open();
	});


	$('#project_log_create_form').submit(function(e){
		e.preventDefault();

		showCover("Saving Project...");

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);
		form_data.append('project_log_project',$('#view_project_project_id').val());

		var endpoint = form.data('create_url');

		if($('#project_log_id').val()!='0')
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
	  				$('#project_log_create_form')[0].reset();
	  				$('.pell-content').html('');

	  				load_project_logs();
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


	window.pell.init({
      element: document.getElementById('editor2'),
      defaultParagraphSeparator: 'p',
      onChange: function (html) {
        //document.getElementById('text-output').innerHTML = html
        $('#project_log_log').val(html);
      }
    });


});