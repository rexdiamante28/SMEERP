$(document).ready(function(){


	//pagination variables
	limit = 16;
	page = 1;


	//payment variables
	merchant_id = 0;
	reference_number = 0;
	service_id = 0;
	payment_choice = "";
	payer_email= "";
	payer_name = "";
	amount_to_pay = 0.00;
	currency = "";
	remarks = "";
	original_recipient = "";
	sys_refno = "";
	resend_button = 0;
	details_api = "";


	function reset_stepper()
	{
		$('#step-1').removeClass('active');
		$('#step-2').removeClass('active');
		$('#step-3').removeClass('active');
	}

	function reset_left_panel()
	{
		$('#merchants_panel').addClass('hidden');
		$('#reference_panel').addClass('hidden');
		$('#second_half').addClass('hidden');
	}

	function goto_step1()
	{
		reset_stepper();
		reset_left_panel();

		$('#step-1').addClass('active');
		$('#merchants_panel').removeClass('hidden');
		$('#i_note').addClass('hidden');
	}

	function goto_step2()
	{
		if(merchant_id!=0)
		{
			reset_stepper();
			reset_left_panel();

			$('#step-2').addClass('active');
			$('#reference_panel').removeClass('hidden');
			$('#i_note').removeClass('hidden');
			
		}
		else
		{
			sys_toast_warning_info("You must select a partner first.");
		}
		
	}

	function reset_steps()
	{
		$('#manual_reference_form')[0].reset();
		$('#m_amount').removeAttr('readonly');
		$('#m_name').removeAttr('readonly');
	}

	function goto_step3()
	{
		$valid = true;

		if(merchant_id==0)
		{
			$valid = false;
		}
		if(reference_number==0)
		{
			$valid = false;
		}
		if(amount_to_pay==0.00)
		{
			$valid = false;
		}
		if(payer_email=="")
		{
			$valid = false;
		}
		if(payer_name=="")
		{
			$valid = false;
		}

		if($valid==true)
		{
			reset_stepper();
			reset_left_panel();

			$('#step-3').addClass('active');
			$('#second_half').removeClass('hidden');
		}
		else
		{
			sys_toast_warning_info("Please fill-up the form first.");
		}
		
	}

	function get_merchants(form)
	{	
		showCover("Loading partners...");
		var formData = new FormData(form);

		formData.append('page',page);
		formData.append('limit',limit);

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

	  			if(json_data.success==false)
	  			{
	  				sys_toast_error(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  				$('#merchants_panel_merchants').html(json_data.message);
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	$('#merchant_search_form').submit(function(e){
		e.preventDefault();
		get_merchants($(this)[0]);
	});

	$('#merchant_search_form').submit();


	$(document).delegate('.merchant-tile','click',function(e){

		if(merchant_id!=$('#'+e.currentTarget.id).data('item_id'))
		{
			reset_steps();
		}
		merchant_id = $('#'+e.currentTarget.id).data('item_id');

		$('#i_merchant_name').html($('#'+e.currentTarget.id).data('item_name'));

		$('#merchants_panel').addClass('hidden');
		$('#reference_panel').removeClass('hidden');

		var elem = $('#'+e.currentTarget.id);
		//$('#summary_payment_partner').html(elem);

		$('#pp_partner').html(elem.data('item_name'));

		get_merchants_services(merchant_id);

		goto_step2();

	});


	function get_merchants_services(merchant_id)
	{	
		showCover("Loading services...");
		var formData = new FormData();

		formData.append('merchant_id',merchant_id);

		$.ajax({
	  		type: 'get',
	  		url: base_url+'app/merchant/get_merchants_services/'+merchant_id,
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
	  				sys_toast_error(json_data.message);
	  			}
	  			else
	  			{
	  				$('#reference_services').html(json_data.message);
	  				$('#m_reference_text').attr("placeholder",json_data.form_labels.ref_label);
	  				$('#m_name').attr("placeholder",json_data.form_labels.name_label);
	  				$('#ref_label').html(json_data.form_labels.ref_label);
	  				$('#name_label').html(json_data.form_labels.name_label);
	  				$('#ref_label_summary').html(json_data.form_labels.ref_label);
	  				$('#name_label_summary').html(json_data.form_labels.name_label);
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}

	

	$('#reference_services_btn').click(function(){
		payer_email = $('#email_address_2').val();
		if(payer_email=='' || payer_email.indexOf("@")<0)
		{
			sys_toast_warning("Please provide a valid email address");
		}
		else
		{
			$('#reference_services').removeClass('hidden');
			$('#reference_reference').addClass('hidden');
		}
	});


	$(document).delegate('.merchant-service-tile','click',function(e){

		service_id = $('#'+e.currentTarget.id).data('item_id');
		reference_number = 0; // if item is selected, always set reference number to 0

		$('#reference_panel').addClass('hidden');
		$('#second_half').removeClass('hidden');

		var elem = $('#'+e.currentTarget.id);
		$('#summary_item_reference').html(elem);

		$('#summary_reference_tag').html('Item');

	});


	function get_details_from_reference(form)
	{
		showCover("Loading payment details...");
		var formData = new FormData(form);

		formData.append('merchant_id',merchant_id);

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

	  			if(json_data.success==false)
	  			{
	  				sys_toast_error(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  				$('#summary_item_reference').html(json_data.message);

	  				$('#second_half').removeClass('hidden');
	  				$('#reference_panel').addClass('hidden');

	  				reference_number = $('#reference_text').val();
	  				payer_email = $('#email_address').val();
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	$('#reference_form').submit(function(e){
		e.preventDefault();
		get_details_from_reference($(this)[0]);
	});


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

		$.ajax({
	  		type: 'post',
	  		url: base_url+'app/payment/initiate_payment',
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


	function validate_manual_form(form)
	{
		showCover("Processing...");
		var formData = new FormData(form);

		formData.append('merchant_id',merchant_id);
		formData.append('m_currency',"PHP");

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

	  			if(json_data.success==false)
	  			{
	  				sys_toast_warning(json_data.message);
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  			}
	  			else
	  			{
	  				$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	  				$('#summary_item_reference').html(json_data.message);

	  				$('#second_half').removeClass('hidden');
	  				$('#reference_panel').addClass('hidden');

	  				reference_number = json_data.message.m_reference_text;
	  				payer_email = json_data.message.m_email_address;
	  				payer_name = json_data.message.m_name;
	  				amount_to_pay = json_data.message.m_amount;
	  				currency = json_data.message.m_currency;
	  				remarks = json_data.message.m_remarks;

					$('#pp_refno').html(reference_number);
					$('#pp_currency').html(currency);
					$('#pp_amount').html(tofixed(amount_to_pay));
					$('#pp_name').html(payer_name);
					$('#pp_email').html(payer_email);
					$('#pp_remarks').html(remarks);

	  				goto_step3();
	  			}
	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	$('#manual_reference_form').submit(function(e){
		e.preventDefault();
		validate_manual_form($(this)[0]);
	})

	$('#step-1').click(function(){
		goto_step1();
	});

	$('#step-2').click(function(){
		goto_step2();
	});

	$('#step-3').click(function(){
		goto_step3();
	});


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


	$('#m_reference_text').blur(function(e){
		if($('#m_reference_text').val()!='')
		{
			showCover("Loading...");

			var ref = $('#m_reference_text').val();

			$.ajax({
		  		type: 'get',
		  		url:  base_url+'app/merchant/get_ref_amount/'+merchant_id+'/'+ref,
		  		data: '',
		  		contentType: false,   
				cache: false,
				processData:false,
		  		success:function(data){
		  			var json_data = JSON.parse(data);
		  			sys_log(json_data.environment,json_data);
		  			hideCover();

		  			$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
		  			

		  			if(json_data.success==false && json_data.message==false)
		  			{
		  				sys_toast_warning(json_data.message);
		  			}
		  			else if(json_data.message==false)
		  			{
		  				sys_toast_warning('Something went wrong. Please try again later.');
		  				goto_step1();
		  				reset_steps();
		  			}
		  			else if(json_data.success==false || json_data.message=="NOAPI")
		  			{
		  				$('#m_amount').val('');
			  			$('#m_amount').removeAttr('readonly');

			  			$('#m_name').val('');
			  			$('#m_name').removeAttr('readonly');
		  			}
		  			else
		  			{
		  				var message_json = JSON.parse(json_data.message);
		  				if(message_json.status == '0')
		  				{
		  					sys_toast_warning(message_json.message);
		  					goto_step1();
		  				}
		  				else
		  				{
		  					var retval = parseFloat(message_json.amount);
			  				if(retval>0)
			  				{
			  					$('#m_amount').val(message_json.amount);
			  					$('#m_amount').attr('readonly','true');

			  					if(message_json.membername!=null)
			  					{	
			  						var name = message_json.membername;
			  						$('#m_name').val(name);
			  						$('#m_name').attr('readonly','true');
			  					}
			  					else
			  					{
			  						$('#m_name').val('');
			  						$('#m_name').removeAttr('readonly');
			  					}
			  				}
			  				else
			  				{
			  					$('#m_amount').val('');
			  					$('#m_amount').removeAttr('readonly');

			  					$('#m_name').val('');
			  					$('#m_name').removeAttr('readonly');
			  				}
		  				}
		  			}
		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}
	});
});
