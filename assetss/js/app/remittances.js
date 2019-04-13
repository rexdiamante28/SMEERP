	$(document).ready(function(){

		loaded_transactions = [];

		fillDataTable = function() {

			var data = {
				'remittances_status': $('#remittance_status_dropdown').val(),
				'date_start': $('#date_start').val(),
				'date_end': $('#date_end').val()
			}

			dataTable = $('#table-grid').DataTable({
				destroy: true,
				"processing" : true,
				"serverSide": true,
				responsive: true,
				"ajax":{
					url:base_url+"app/transactions/remittances_table", // json datasource
					type: "post",  // method  , by default get
					data: data,
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
						$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
						$("#table-grid_processing").css("display","none");
						$('.btnExcel').hide();
					}
				},
				"columnDefs": [
					//{ className: "text-center", "targets": [6,7,8,9] },
					//{ orderable: false, "targets": [ 6,9 ] }
				]
			});
		}


		function get_date()
		{
			showCover("Loading date...");
			$.ajax({
		  		type: 'get',
		  		url: base_url+'sys/settings/get_date/',
		  		data: '',
		  		contentType: false,   
				cache: false,      
				processData:false,
		  		success:function(data){
		  			hideCover();

		  			$('#date_start').val(data);
		  			$('#date_end').val(data);

		  			fillDataTable();
		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}
		
		
		get_date();


		$('#search_btn').click(function(){
			fillDataTable();
		});

		$('#reset_btn').click(function(){
			$('#search_text').val('');
			$('#date_start').val('');
			$('#date_end').val('');

			fillDataTable();
		});


		function draw_transaction_view(data){
			$('#remittance_view_modal_body').html(data);
		}

		function get_transaction_details(remittance_id)
		{
			showCover("Loading transaction information...");
			$.ajax({
		  		type: 'get',
		  		url: base_url+'app/transactions/get_remittance_details/'+remittance_id,
		  		data: '',
		  		contentType: false,   
				cache: false,      
				processData:false,
		  		success:function(data){
		  			var json_data = JSON.parse(data);
		  			sys_log(json_data.environment,json_data);
		  			hideCover();

		  			draw_transaction_view(json_data.message);
		  			$('#remittance_view_modal').modal();
		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}

		$(document).delegate('.view_transaction','click',function(e){
			get_transaction_details(e.currentTarget.id);
		});


		$('#add_btn').click(function(){
			$('#btn_save_remittance').addClass('hidden');
			$('#proceed_1').removeClass('hidden');
			loaded_transactions = [];
			$('#pg_2').html('');
			$('#remittance_add_modal').modal();
		});


		function get_covered_transactions()
		{
			var post_data = {
				'date_from' : $('#date_start_1').val(),
				'date_to'   : $('#date_end_2').val(),
				'merchant_id' : 0
			}


			showCover("Loading covered transactions...");
			$.ajax({
		  		type: 'post',
		  		url: base_url+'app/transactions/get_covered_transactions/',
		  		data: post_data,
		  		success:function(data){
		  			var json_data = JSON.parse(data);
		  			sys_log(json_data.environment,json_data);
		  			hideCover();

		  			if(json_data.success==true)
		  			{
		  				$('#pg_2').html(json_data.message);
		  				loaded_transactions = json_data.raw_message;
		  				$('#btn_save_remittance').removeClass('hidden');
						$('#proceed_1').addClass('hidden');
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
		}

		$('#proceed_1').click(function(){
			get_covered_transactions();
		});


		$('#btn_save_remittance').click(function(){

			if(loaded_transactions.length>0)
			{
				var post_data = {
					'date_from' : $('#date_start_1').val(),
					'date_to'   : $('#date_end_2').val(),
					'loaded_transactions': loaded_transactions,
					'total_amount_received' : $('#f_total_amount_received').val(),
					'reason': $('#f_remarks').val(),
					'merchant_select': 0,
					'bank_select': 0
				}

				showCover("Saving...");

				$.ajax({
			  		type: 'post',
			  		url: base_url+'app/transactions/save_dp_remittance/',
			  		data: post_data,
			  		success:function(data){
			  			var json_data = JSON.parse(data);
			  			sys_log(json_data.environment,json_data);
			  			hideCover();

			  			if(json_data.success==true)
			  			{
			  				sys_toast_success(json_data.message);
			  				$('#remittance_add_modal').modal('hide');
			  				fillDataTable();
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
			}
			else
			{
				sys_toast_warning('No transaction has been included. Please select a different date range.');

				$('#btn_save_remittance').addClass('hidden');
				$('#proceed_1').removeClass('hidden');
			}
		});


});