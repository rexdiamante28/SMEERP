$(document).ready(function(){

	base_url = base_url = $("body").data('base_url');

	test_login = "111222333";
	test_password = "cdx123";
	return_url = "";

	$('.sss').hide();


	process_payment = function(mrf){

		showCover("Processing payment...");

		$.ajax({
	  		type: 'post',
	  		url: base_url+'testpay/get_return_url4',
	  		data:{'mrf':mrf, 'channel': $('#payment_source').val()},
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




	$('#submit_btn').click(function(){
		var valid = true;

		i_payment_source = $('#payment_source').val();
		
		if(i_payment_source == ""){valid = false;}

		if(valid == false)
		{	
			alert("Select payment source");
		}
		else
		{
			//get client's return url based
			var mrf = $('#mrf').html();

			process_payment(mrf);

		}


	});

});
