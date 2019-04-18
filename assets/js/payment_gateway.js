$(document).ready(function(){

	base_url = base_url = $("body").data('base_url');

	payment_option = 1; //1 mastercard 2 visa

	test_card_master = "5422882800700019";
	test_card_visa = "4918914107195014";
	test_card_ccv = "123";
	test_card_exp_month = "03";
	test_card_exp_year = "2020";
	test_card_name = "Juan Dela Cruz";

	return_url = "";

	//$('#payment_gateway_frame1').hide();
	$('.sss').hide();
	$('#payment_gateway_frame2').hide();

	update_payment_image = function(){
		if(payment_option==1)
		{
			$('#ppp_visa1').hide();
			$('#ppp_mastercard1').show();
		}
		else
		{
			$('#ppp_visa1').show();
			$('#ppp_mastercard1').hide();
		}
	}

	process_payment = function(mrf){

		showCover("Processing payment...");

		$.ajax({
	  		type: 'post',
	  		url: base_url+'testpay/get_return_url',
	  		data:{'mrf':mrf, 'payment_option': payment_option},
	  		success:function(data){
	  			hideCover();
	  			var json_data = JSON.parse(data);
	  			console.log(json_data);
	  			return_url = json_data.return_url+'?refno='+json_data.refno+'&payment_status='+json_data.payment_status;

	  			$('.hhh').hide();
				$('.sss').show();

				setTimeout(function(){ window.location = return_url }, 2000);
	  		},
	  		error: function(error){
	  			hideCover();
	  			$.toast({
				    heading: 'Error',
				    text: 'Something went wrong. Please try again.',
				    icon: 'error',
				    loader: false,  
				    stack: false,
				    position: 'top-center', 
					allowToastClose: false,
					bgColor: '#d9534f',
					textColor: 'white'  
				});
	  		}
	  	});
	}


	$('#ppp_visa').click(function(){
		$('#payment_gateway_frame1').hide();
		$('#payment_gateway_frame2').show();
		payment_option = 2;
		update_payment_image();
	});


	$('#ppp_mastercard').click(function(){
		$('#payment_gateway_frame1').hide();
		$('#payment_gateway_frame2').show();
		payment_option = 1;
		update_payment_image();
	});


	$('#submit_btn').click(function(){
		var valid = true;

		i_test_card = $('#card_number').val();
		i_test_card_ccv = $('#ccv').val();
		i_test_card_exp_month = $('#month').val();
		i_test_card_exp_year = $('#year').val();
		i_test_card_name = $('#name_on_card').val();
		i_email = $('#email').val();

		if(payment_option==1)
		{
			if(i_test_card != "5422882800700019"){valid = false;}
		}
		else
		{
			if(i_test_card != "4918914107195014"){valid = false;}
		}
		
		if(i_test_card_ccv != "123"){valid = false;}
		if(i_test_card_exp_month != "03"){valid = false;}
		if(i_test_card_exp_year != "2020"){valid = false;}
		if(i_test_card_name != "Juan Dela Cruz"){valid = false;}
		if(i_email == ""){valid = false;}

		if(valid == false)
		{	
			alert("Please fill out the form with correct information.");
		}
		else
		{
			//get client's return url based
			var mrf = $('#mrf').html();

			process_payment(mrf);

		}


	});

});
