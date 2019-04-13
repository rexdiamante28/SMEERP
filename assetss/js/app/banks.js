$(document).ready(function(){

	searchstring = "";

	fillDataTable = function() {
		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/bank/banks_list_table", // json datasource
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
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
					$('.btnExcel').hide();
				}
			},
			"columnDefs": [
			   { orderable: false, "targets": [ 2 ] }
			 ]
		});
	}


	
	fillDataTable(searchstring);
  

	$('#searchBtn').click(function(){
		searchstring = $('#searchtext').val();
		fillDataTable(searchstring);
	});


	$('#new_bank_btn').click(function(){
		$('#bank_form')[0].reset();
		$('#add_bank_modal').modal();
	});



	$('#bank_form').submit(function(event){
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
							$('#bank_form')[0].reset();
							$('#add_bank_modal').modal('hide');

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

	});

	$('#initiate_btn').click(function(){
		$('#bank_form').submit();	
	});


	$(document).delegate('.view','click',function(e){
		showCover("Loading details...");
		$.ajax({
	        type:'get',
	        url:base_url+'app/bank/view_bank/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);
	        	

	        	$('#f_id').val(json_data.message.message.id);
				$('#f_bank_name').val(json_data.message.message.name);
				$('#f_branch').val(json_data.message.message.branch);
				$('#add_bank_modal').modal();

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


	$(document).delegate('.delete','click',function(e){
		$('#bank_id_number_delete').val(e.currentTarget.id);
		$('#bank_account_delete_prompt_modal').modal();
	});


	function delete_bank(bank_id){
		showCover("Processing...");
		$.ajax({
	        type:'get',
	        url:base_url+'app/bank/delete_bank/'+bank_id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);
	        	
	        	sys_toast_success(json_data.message.message);

				$('#bank_account_delete_prompt_modal').modal('hide');
				fillDataTable(searchstring);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}
 
	$('#initiate_bank_delete_btn').click(function(){
		delete_bank($('#bank_id_number_delete').val());
	})



	$(document).delegate('.btn_delete_bank_account','click',function(e){
		$('#bank_account_number_delete').val($(this).data('id'));
		$('#bank_account_delete_prompt_modal').modal();
	});



});
