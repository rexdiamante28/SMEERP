	$(document).ready(function(){

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
					url:base_url+"app/transactions/myremittances_table", // json datasource
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


		
		fillDataTable();


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

	});