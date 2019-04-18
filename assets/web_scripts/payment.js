exec_dragonpay = function(){
	showCover("Processing payment...");

	    $.ajax({
        type:'post',
        url:base_url+'payment/dragonpay',
        data:{'txnid':f_refno, 'amount':f_amount, 'email':f_email, 'generate_referenceno':f_refno,'selected_payment' : selected_option, 'curcode':'PHP'},
        success:function(data){
        	hideCover();
			//console.log(data);
        	window.location = data.url;
        	//window.open(data.url,'_blank');
            //window.open = (data.url);
            // alert(data.url);
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


exec_asiapay = function (){
	showCover("Processing payment...");

	var data = {
		'txnid':f_refno,
		 'amount':f_amount,
		  'email':f_email,
		 'generate_referenceno':f_refno,
		 'selected_payment': selected_option,
		 'curcode':'PHP', 
		 'card_origin': card_origin
		}
    $.ajax({
        type:'post',
        url:base_url+'payment/asiapay',
        data: data,
        success:function(data){
        	hideCover();
        	console.log(data);
            if (data.success == 1) {
            	window.location = data.url;
            	//window.open(data.url,'_blank');
                //window.open(data.url);
                //alert(data.url);
            }else{
                alert('error redirect to payment!');
            }
            
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


$(document).ready(function(){

	hideCover();

	f_currency = $('#currency').val();
	f_amount = $('#amount').val();
	f_email = $('#email').val();
	f_refno = $('#refno').val();

	base_url = base_url = $("body").data('base_url');

	selected_option = 1; // 1 credit card, 2 debit card, 3 online banking
	card_origin = 1; // 1 local , 2 international

	chosen_method_view = '';

	$('#card_origin_tr').hide();

	show_confirm_view = function()
	{
		$("html").scrollTop(0);
		$("#chosenMethod").html(chosen_method_view);
		$("#payment-option").css("display", "none");
		$("#payment-confirm").css("display", "block");
	}

	update_card_origin_val = function()
	{
		if(card_origin == 1)
		{
			$('#card_origin_td').html("PHILIPPINES");
		}
		if(card_origin == 2)
		{
			$('#card_origin_td').html("OTHER COUNTRIES");
		}
		
	}


	$(".method-container").click(function(){

		chosen_method_view = $(this).html();

		selected_option = $(this).attr("data-value");

		if(selected_option == 1 || selected_option == 2)
		{
			$('#card_origin_modal').modal();
		}
		else
		{
			$('#card_origin_tr').hide();
			show_confirm_view();
		}
	});	

	$("#changeMethod").click(function(){
		$("html").scrollTop(0);
		$("#payment-option").css("display", "block");
		$("#payment-confirm").css("display", "none");
	});

	$(".home.payment-method .method").click(function(){
		$(".home.payment-method .method.clicked").removeClass("clicked");
		$(this).addClass("clicked");
	});


	$('#btn_local').click(function(){
		card_origin = 1;
		$('#card_origin_modal').modal('hide');
		show_confirm_view();

		update_card_origin_val();
		$('#card_origin_tr').show();
	});

	$('#btn_international').click(function(){
		card_origin = 2;
		$('#card_origin_modal').modal('hide');
		show_confirm_view();

		update_card_origin_val();
		$('#card_origin_tr').show();
	});

});