$(document).ready(function(){

	//payment variables
	merchant_id = 0;
	reference_number = 0;
	payment_choice = "";
	payer_email= "";
	payer_name = "";
	mobile_number = "";
	signature = "";
	amount_to_pay = 0.00;
	currency = "";
	remarks = "";
	original_recipient = "";
	sys_refno = "";
	resend_button = 0;
	details_api = "";


	function get_token()
	{
		showCover("Initiating payment...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'auth/authentication/get_token',
	  		data: '',
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			ajax_token_name = json_data.data.csrf_name;
	  			ajax_token = json_data.data.csrf_hash;

	  			initiate_payment();

	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	function reset_payment_options()
	{
		$('.method').removeClass('active');
	}

	$('.method').click(function(e){
		payment_choice = $('#'+e.currentTarget.id).data('value');
		reset_payment_options();
		$('#'+e.currentTarget.id).addClass('active');
		$('#pp_payment_method').html(payment_choice);
		//get_token();
	});



	function initiate_payment()
	{
		showCover("Initiating payment...");
		var formData = new FormData();

		formData.append([ajax_token_name],ajax_token);
		formData.append('merchant_id',merchant_id);
		formData.append('reference_number',reference_number);
		formData.append('payment_choice',payment_choice);
		formData.append('email_address',payer_email);
		formData.append('payer_name',payer_name);
		formData.append('amount_to_pay',amount_to_pay);
		formData.append('currency',currency);
		formData.append('remarks',remarks);
		formData.append('mobile_number',mobile_number);
		formData.append('signature',signature);

		$.ajax({
	  		type: 'post',
	  		url: base_url+'api/payment/initiate_payment',
	  		data: formData,
	  		contentType: false,
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			if(json_data.success==false)
	  			{
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  				if(json_data.payment_status=='P')
	  				{	
	  					original_recipient = json_data.recipient;
	  					sys_refno = json_data.refno;
	  					$('#email_receiver_rec').html(json_data.recipient);
	  					$('#pendingMessageModal').modal();
	  				}
	  				else
	  				{
	  					sys_toast_warning(json_data.message);
	  				}
	  			}
	  			else
	  			{
	  				window.location = json_data.message;
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}



	$('#resend1').click(function(e){
		resend_button = 1;
		$('#instruction_resend_form').submit();
	});


	$('#resend2').click(function(e){
		resend_button = 2;
		$('#instruction_resend_form').submit();
	});


	$('#instruction_resend_form').submit(function(e){
		e.preventDefault();

		showCover("Processing...");
		var form = $(this)[0];
		var formData = new FormData(form);

		/*if($('#newemail').val()!="")
		{
			formData.append('r_recipient',$('#newemail').val());
		}
		else
		{
			formData.append('r_recipient',original_recipient);
		}*/

		formData.append('r_recipient',original_recipient);
		formData.append('r_sys_refno', sys_refno);
		formData.append('resender', resend_button);

		$.ajax({
	  		type: 'post',
	  		url: form.action,
	  		data: formData,
	  		contentType: false,   
			cache: false,
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();


	  			$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);

	  			if(json_data.success==false)
	  			{
	  				sys_toast_warning(json_data.message);
	  			}
	  			else
	  			{
	  				sys_toast_success(json_data.message);
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	});


	$('#init_payment').click(function(e){
		if($('#customCheck1').prop('checked')==false)
		{
			sys_toast_warning("Please read and agree to terms and conditions before proceeding.");
		}
		else
		{
			get_token();
		}
	});


	function highlight_selected_payment()
	{
		var selected_payment = $('#pp_payment_choice').html();

		if(selected_payment == '1')
		{
			$('#method1').addClass('active');
			$('#pp_payment_choice').html(selected_payment);
		}
		else if(selected_payment == '2')
		{
			$('#method2').addClass('active');
			$('#pp_payment_choice').html(selected_payment);
		}
		else if(selected_payment == '4')
		{
			$('#method3').addClass('active');
			$('#pp_payment_choice').html(selected_payment);
		}
	}

	highlight_selected_payment();


	function asign_values()
	{
		merchant_id = $('#ppp_merchant_id').val();
		reference_number = $('#ppp_reference_number').val();
		payment_choice = $('#ppp_payment_choice').val();
		payer_email = $('#ppp_payer_email').val();
		payer_name = $('#ppp_payer_name').val();
		amount_to_pay = $('#ppp_amount_to_pay').val();
		currency = $('#ppp_currency').val();
		remarks = $('#ppp_remarks').val();
		mobile_number = $('#ppp_mobile_number').val();
		signature = $('#ppp_signature').val();

	}

	asign_values();


});
