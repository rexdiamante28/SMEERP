$(document).ready(function(){

	function get_figures()
	{

		var postdata = {
			'date_start': $('#date_start').val(),
			'date_end' : $('#date_end').val(),
		}

		$.ajax({				
				url: base_url+'app/dashboard/get_summary',
				type: 'post',
				data: postdata,
			success : function(data){
				json_data = JSON.parse(data);
				sys_log(json_data.environment,json_data);

				if(json_data.success == true)
				{
					$('#active_merchants').html(json_data.message.active_merchants);
					$('#active_payers').html(json_data.message.active_payers);
					$('#expired_transactions').html(json_data.message.expired_transactions);
					$('#failed_transactions').html(json_data.message.failed_transactions);
					$('#inactive_merchants').html(json_data.message.inactive_merchants);
					$('#inactive_payers').html(json_data.message.inactive_payers);
					$('#paid_transactions').html(json_data.message.paid_transactions);
					$('#pending_transactions').html(json_data.message.pending_transactions);
				}
				else
				{
					sys_toast_error("Something went wrong. Please try again.");
				}
						
				hideCover();
				//sys_toast_success(json_data.message);

				},
			error : function(error){
				sys_toast_error(error.responseText);
			}
		});
	}


	get_figures();

	$('#search_btn').click(function(){
		get_figures();
	});

});