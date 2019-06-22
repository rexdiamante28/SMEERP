$(document).ready(function(){


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////Data Entry//////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	$('#people_create_btn').click(function(){
		$('#people_create_form')[0].reset();
		$('#people_create_modal').modal();
	});



	$('#people_create_form').submit(function(e){

		showCover("Saving...");

		e.preventDefault();

		var form = $(this);
		var form_data = new FormData(form[0]);

		form_data.append([ajax_token_name],ajax_token);

		var endpoint = form.data('create_url');

		if($('#people_primary').val()!='0')
		{
			form_data.append('people_primary',$('#people_primary').val());
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
	  				$('#people_create_form')[0].reset();
	  				$('#people_create_modal').modal('hide');
	  				load_people();
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




	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////Additional functions start//////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Additional functions end/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
