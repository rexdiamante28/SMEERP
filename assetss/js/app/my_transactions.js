$(document).ready(function(){

	fillDataTable = function() {

		var data = {
			'payment_status': $('#payment_status_dropdown').val(),
			'searchstring': $('#search_text').val(),
			'date_start': $('#date_start').val(),
			'date_end': $('#date_end').val()
		}


		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/transactions/my_transactions_list_table", // json datasource
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
			   { className: "text-center", "targets": [4,5,6,7] },
			   { orderable: false, "targets": [ 4,7 ] }
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


	$('#newmerchant_btn').click(function(){
		$('#addmerchantmodal').modal();
	});




	function draw_transaction_view(data){
		$('#tm_header_ref').html('TRANSACTION REF #: '+data.merchant_refno);
		$('#tm_merchant_ref').html(' '+data.merchant_refno);
		$('#tm_payment_ref').html(' '+data.gateway_refno);
		$('#tm_transaction_date').html(' '+data.trandate);
		$('#tm_payer_name').html(' '+data.name);
		$('#tm_payer_email').html(' '+data.email);
		$('#tm_payment_amount').html(' '+data.currency+' '+tofixed(data.amount));
		
		if(data.payment_mode=='1')
		{
			data.payment_mode = "Online Bank";
		}
		else if (data.payment_mode=='2')
		{
			data.payment_mode = "Over The Counter (Bank)";
		}
		else if (data.payment_mode=='4')
		{
			data.payment_mode = "Over The Counter (Non-bank)";
		}
		else if (data.payment_mode=='6')
		{
			data.payment_mode = "Over The Counter bank and non-bank";
		}
		else
		{
			data.payment_mode = "Undefined";
		}


		$('#tm_payment_mode').html(data.payment_mode);
		$('#tm_payment_status').html(' '+draw_transaction_status(data.payment_status));
	}

	function get_transaction_details(transaction_id)
	{
		showCover("Loading transaction information...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'app/transactions/get_transaction_details/'+transaction_id,
	  		data: '',
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			draw_transaction_view(json_data.message);
	  			$('#transaction_view_modal').modal();
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}

	$(document).delegate('.view_transaction','click',function(e){
		get_transaction_details(e.currentTarget.id);
	});


	function get_merchant_labels()
	{
		showCover("Loading...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'app/merchant/get_labels/',
	  		data: '',
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			if(json_data.success==true)
	  			{
	  				$('#m_ref_label_t').html(json_data.form_labels.ref_label);
	  				$('#m_ref_label_m').html(json_data.form_labels.ref_label);
	  				
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}

	get_merchant_labels();

});