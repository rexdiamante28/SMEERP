loadingImg = "";

$(document).ready(function(){
	loadingImg = $('#items_listing').html();
	get_store_items();
	get_temp_orders();

});


function get_store_items()
{	
	$('#items_listing').html(loadingImg);

	var data = '';
	var search = $('#search').val();

	data = 'search='+search;

	$.ajax({				
		type : 'POST',
		url  : 'get_store_items',
		data : data,
		success : function(response){		
			$('#items_listing').html(response);
			set_handler();
		}
	});
}

function set_handler()
{
	$('.store_items').click(function(event){

		

		//unique_order_modal

		if($('#'+event.currentTarget.id).data('unique')=='1')
		{
			$('#unique_order_modal').modal();
		}
		else
		{
			$('#add_record_form')[0].reset();
			$('#item_movement_item_id').val(event.currentTarget.id.replace('item_movement_item_id',''));
			$('#error_message').addClass('hidden');
			$('#add_record_modal').modal();
		}

	})
}

function set_handler2()
{
	$('.remove-order').click(function(event){

		$.ajax({				
			type : 'GET',
			url  : 'remove_order/'+event.currentTarget.id,
			data : '',
			success : function(response){
				$result= JSON.parse(response);
				if($result.success===true)
				{
					get_temp_orders();
				}
				else
				{
					alertify.error(result.message);
				}
				
			}
		});
	});
}


$('#search_form').submit(function(event){
	event.preventDefault();

	get_store_items();
})


function get_temp_orders(){

	$('#order_listing').html(loadingImg);

	$.ajax({				
		type : 'POST',
		url  : 'get_temp_orders',
		data : '',
		success : function(response){		
			$('#order_listing').html(response);
			set_handler2();
		}
	});
}

$('#add_record_form').submit(function(event){
			event.preventDefault();

			var form = $(this);

			$.ajax({				
				url: form.attr('action'),
	    	    type: form.attr('method'),
				data: form.serialize(),
				success : function(response){
					var result = JSON.parse(response);
					console.log(response);
					if(result.success===true)
					{
						get_temp_orders();
						$('#add_record_modal').modal('hide');
					}
					else
					{
						$('#error_message').removeClass('hidden');
						$('#error_message').html(result.message);
					}
					
				}
			});
})


$('#unique_order_form').submit(function(event){
			event.preventDefault();

			var form = $(this);

			$.ajax({				
				url: form.attr('action'),
	    	    type: form.attr('method'),
				data: form.serialize(),
				success : function(response){
					var result = JSON.parse(response);
					console.log(response);
					if(result.success===true)
					{
						get_temp_orders();
						$('#unique_order_modal').modal('hide');
					}
					else
					{
						$('#unique_error_message').removeClass('hidden');
						$('#unique_error_message').html(result.message);
					}
					
				}
			});
})


unique_order_form

$('#payment_trigger').click(function(){
	$('#payment_modal #total').val($('#left_pane_total').html().replace('P ','').replace(',',''));
	$('#payment_modal #tax').val($('#left_pane_tax').html().replace('P ','').replace(',',''));
	$('#payment_modal #discount').val($('#left_pane_discount').html().replace('P ','').replace(',',''));
	$('#payment_modal').modal();
});


$('#pay_order_form').submit(function(event){
	event.preventDefault();

	//check if the payment is valid before submitting
	var total = parseFloat($('#payment_modal #total').val().replace(',',''));
	var payment = parseFloat($('#payment_modal #amount_due').val());
	if(!isNaN(payment))
	{
		if(payment<total)
		{
			var balance = parseFloat($('#payment_modal #amount_balance').val());

			if(isNaN(balance))
			{	
				$('#payment_modal #error_message').html('Insufficient Amount Due.');
				$('#payment_modal #error_message').removeClass('hidden');
			}
			else
			{
				if((payment+balance) == total)
				{
					if($('#balance_due_date').val()=='')
					{
						$('#payment_modal #error_message').html('Balance due date is required');
						$('#payment_modal #error_message').removeClass('hidden');
					}
					else
					{
						$('#payment_modal #change').val(((balance+payment)-total).toFixed(2));
						$('#payment_modal #error_message').html('');
						$('#payment_modal #error_message').addClass('hidden');
						$('#payment_modal #amount_due').val(payment.toFixed(2));

						showCover("Processing Payment...");
						var form = $(this);

						$.ajax({				
							url: form.attr('action'),
				    	    type: form.attr('method'),
							data: form.serialize(),
							success : function(response){
								var result = JSON.parse(response);
								if(result.success===true)
								{

									$('#payment_modal #error_message').html('');
									$('#payment_modal #error_message').addClass('hidden');


									get_temp_orders();
									hideCover();
									var location = 'print_receipt/'+result.message;
									window.open(location,'_blank');

									$('#payment_modal').modal('hide');
									$('#pay_order_form')[0].reset();
								}
								else
								{
									$('#payment_modal #error_message').removeClass('hidden');
									$('#payment_modal #error_message').html(result.message);
									hideCover();
								}
								
							}
						});
					}
				}
				else
				{
					$('#payment_modal #error_message').html('Mismatched amount');
					$('#payment_modal #error_message').removeClass('hidden');
				}
			}
			
		}
		else
		{	
			$('#payment_modal #change').val((payment-total).toFixed(2));
			$('#payment_modal #error_message').html('');
			$('#payment_modal #error_message').addClass('hidden');
			$('#payment_modal #amount_due').val(payment.toFixed(2));

			showCover("Processing Payment...");
			var form = $(this);

			$.ajax({				
				url: form.attr('action'),
	    	    type: form.attr('method'),
				data: form.serialize(),
				success : function(response){
					var result = JSON.parse(response);
					if(result.success===true)
					{

						$('#payment_modal #error_message').html('');
						$('#payment_modal #error_message').addClass('hidden');


						get_temp_orders();
						hideCover();
						var location = 'print_receipt/'+result.message;
						window.open(location,'_blank');

						$('#payment_modal').modal('hide');
						$('#pay_order_form')[0].reset();
					}
					else
					{
						$('#payment_modal #error_message').removeClass('hidden');
						$('#payment_modal #error_message').html(result.message);
						hideCover();
					}
					
				}
			});

		}
	}
	else
	{
		$('#payment_modal #error_message').html('Invalid amount due.');
		$('#payment_modal #error_message').removeClass('hidden');
	}
});