$(document).ready(function(){

	searchstring = "";
	imageBlob = '';

	fillDataTable = function() {
		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"sys/settings/dragonpay_rates_table", // json datasource
				type: "post",  // method  , by default get
				data: {'searchstring': searchstring },
				beforeSend:function(data){
					showCover("loading list...");
				},
				complete: function(data)
				{	
					hideCover();
					var response = $.parseJSON(data.responseText);
					console.log(response);
				},
				error: function(){  // error handling
					hideCover();
					$(".table-grid-error").html("");
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
				}
			}/*,
			"columnDefs": [
			   { className: "ap-t", "targets": [ 3,4 ] },
			   { className: "dp-t", "targets": [ 5,6,7,8,9,10 ] }
			 ]*/
		});
	}


	
	fillDataTable(searchstring);


	$('#newrate_btn').click(function(){
		$('#add_rate_modal').modal();
		$('#dragonapay_rate_form')[0].reset();
	});


	$('#initiate_btn').click(function(){

		$('#dragonapay_rate_form').submit();

	});


	$('#dragonapay_rate_form').submit(function(e){
		e.preventDefault();

		event.preventDefault();
		var form = $(this);
		postdata = new FormData(form[0]);
		showCover("Processing...");
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
						$('#dragonapay_rate_form')[0].reset();
						$('#add_rate_modal').modal('hide');

						$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
						sys_toast_success(json_data.message);
						fillDataTable(searchstring);
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

	})


	$(document).delegate('.view','click',function(e){
		showCover("Loading details...");
		$.ajax({
	        type:'get',
	        url:base_url+'sys/settings/get_dragonpay_rate/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);

	        	$('#f_id').val(json_data.id);
	        	$('#f_online_bank').val(json_data.online_banking);
	        	$('#f_otc_bank').val(json_data.otc_bank);
	        	$('#f_otc_non_bank').val(json_data.otc_non_bank);
	        	$('#add_rate_modal').modal();
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


	$(document).delegate('.activate','click',function(e){
		showCover("Processing...");
		$.ajax({
	        type:'get',
	        url:base_url+'sys/settings/activate_rate/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);

	        	if(json_data.success==true)
	        	{
	        		sys_toast_success(json_data.message);
	        	}
	        	else
	        	{
	        		sys_toast_error(json_data.message);
	        	}

	        	fillDataTable(searchstring);

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


	$(document).delegate('.delete','click',function(e){
		showCover("Processing...");
		$.ajax({
	        type:'get',
	        url:base_url+'sys/settings/delete_rate/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);

	        	if(json_data.success==true)
	        	{
	        		sys_toast_success(json_data.message);
	        	}
	        	else
	        	{
	        		sys_toast_error(json_data.message);
	        	}

	        	fillDataTable(searchstring);

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


});
