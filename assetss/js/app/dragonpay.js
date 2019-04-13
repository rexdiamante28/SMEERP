$(document).ready(function(){

	exec_dragonpay = function(txnid, amount, email, generate_referenceno){

		showCover("Processing payment...");

		/*if(selected_payment_type=="Online Banking")
		{
			selected_payment = 2;
		}
		else
		{
			selected_payment = 3;
		}*/

		selected_payment_mode = 3;

	    $.ajax({
	        type:'post',
	        url:base_url+'shop/dragonpay',
	        data:{'txnid':txnid, 'amount':amount, 'email':email, 'generate_referenceno':generate_referenceno,'selected_payment' : selected_payment_mode, 'curcode':'PHP'},
	        success:function(data){
	        	hideCover();
	        	//console.log(data);

	        	window.location = data.url;
	        },
	        error: function(error){
	        	hideCover();
	  			$.toast({
				    heading: 'Error',
				    text: error.responseText,
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

});