$('#sales_report_form').submit(function(event){
		event.preventDefault();
        var form = $(this);
        $.ajax({				
				url: form.attr('action'),
	        	type: form.attr('method'),
				data: form.serialize(),
			success : function(data){
				var response = (JSON.parse(data));
				if(response.success===false)
				{
					$('#sales_report_modal #error_message').html(response.message);
					$('#sales_report_modal #error_message').removeClass('hidden');
				}
				else
				{	
					$('#sales_report_modal #error_message').html('');
					$('#sales_report_modal #error_message').addClass('hidden');

					var b_id = $('#sales_report_modal #branch_id').val();
					var sdate = $('#start_date').val();
					var edate = $('#end_date').val();

					var url = "../../pos/print_sales_report/"+b_id+"/"+sdate+"/"+edate;
					window.open(url,"_blank")

				}
			},
			error : function(error){
				alertify.error(error);
			}
		});
});


$('#inventory_report_form').submit(function(event){
		event.preventDefault();
        var form = $(this);
        $.ajax({				
				url: form.attr('action'),
	        	type: form.attr('method'),
				data: form.serialize(),
			success : function(data){
				var response = (JSON.parse(data));
				if(response.success===false)
				{	
					console.log(response.message);
					$('#inventory_report #error_message').html(response.message);
					$('#inventory_report #error_message').removeClass('hidden');
				}
				else
				{	
					$('#inventory_report #error_message').html('');
					$('#inventory_report #error_message').addClass('hidden');

					var b_id = $('#inventory_report #branch_id').val();

					var url = "../../pos/print_inventory_report/"+b_id;
					window.open(url,"_blank")

				}
			},
			error : function(error){
				alertify.error(error);
			}
		});
});

