$('#add_item_in_movement_button').click(function(){
	var movement_type = $('#add_item_in_movement_details_form #movement_type').val();

	if(movement_type == "Inbound"){
		get_items();
	}else{

		$("#e-identifier").focus();
		$("#e_addOutboundItem").modal('show');
		scanItems();
	}

});

function get_items()
{
	showCover("Fetching Items...");

	var data = '';
	var search = $('#items_search').val();
	var record_per_page = $('#items_record_per_page').val();

	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_items',
		data : data,
		success : function(response){
			$('#item_movements_item_list').html(response);
			$('#add_item_in_movement_modal').modal();
			hideCover();
			set_handler2();
		},
		error: function(error){
			console.log(error.responseText);
		}
	});
}


function set_handler2(){

	$('.add_to_item_trigger').click(function(e){

		if($('#add_item_in_movement_details_form #movement_type').val() === "Outbound"){
			$('#add_item_in_movement_details_form #buying_price-div').css("display", "none");
			$('#add_item_in_movement_details_form #selling_price-div').css("display", "none");
			$('#add_item_in_movement_details_form #supplier-div').css("display", "none");
			$('#add_item_in_movement_details_form #incentives-div').css("display", "none");
			$('#add_item_in_movement_details_form #date_delivered-div').css("display", "none");
			$('#add_item_in_movement_details_form #remarks-div').css("display", "none");
		}else{
			$('#add_item_in_movement_details_form #buying_price-div').css("display", "block");
			$('#add_item_in_movement_details_form #selling_price-div').css("display", "block");
			$('#add_item_in_movement_details_form #supplier-div').css("display", "block");
			$('#add_item_in_movement_details_form #incentives-div').css("display", "block");
			$('#add_item_in_movement_details_form #remarks-div').css("display", "block");
		}
		
		var item_id = event.currentTarget.id;
		$('#add_item_in_movement_details_form #item_id').val(event.currentTarget.id);
		$('#add_item_in_movement_details_modal').modal();
		$('#add_item_in_movement_details_form #error_message').addClass('hidden');

	});

}


$('#items_search_form').submit(function(event){
	event.preventDefault();
	$('#item_movements_item_list').html(loading_content);
	get_items();

});

$('#items_record_per_page').change(function(){
	$('#item_movements_item_list').html(loading_content);
	get_items();
})



$('#add_item_in_movement_details_form').submit(function(event)
{
		event.preventDefault();
        $('#add_item_in_movement_details_form #form-loading').removeClass("hidden");
        add_item_in_movement($(this));

});



function add_item_in_movement(form)
{
    $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: form.attr('method')
        }).done(function(response) {

            $('#add_item_in_movement_details_form #form-loading').addClass("hidden");
            var response = JSON.parse(response);
            if(response.success===false)
            {
            	$('#add_item_in_movement_details_form #error_message').removeClass('hidden');
            	$('#add_item_in_movement_details_form #error_message').html(response.message);
            }
            else
            {
            	alertify.success(response.message);
            	$('#add_item_in_movement_details_modal').modal('hide');
            	showCover("Fetching record...");

				$.ajax({				
					type : 'GET',
					url  : 'get_stock_movement_items/'+$('#add_item_in_movement_details_form #movement_id').val(),
					data : '',
					success : function(response){
						hideCover();
						$('#details_modal_content').html(response);
					}
				});

            	$('#error_message').addClass("hidden");

            	//get_item_movements();
            }

    });
}


$(document).delegate(".view_identifiers", "click", function(e) {
	
	showCover('Fetching data...');

	var id = e.currentTarget.id;
	var item_id = e.currentTarget.dataset.item_id;
	var branch_id = e.currentTarget.dataset.branch_id;

  	$.ajax({				
		type : 'POST',
		url  : 'get_item_movement_item_uids/',
		data : {id,item_id,branch_id},
		success : function(response){
			hideCover();
			$('#identifiers_modal_body').html(response);
			$('#identifiers_modal').modal();
		}
	});

});

$(document).delegate(".view_identifiers_acc", "click", function(e) {
	showCover('Fetching data...');
  	$.ajax({				
		type : 'GET',
		url  : 'get_item_movement_item_uids_acc/'+e.currentTarget.id,
		data : '',
		success : function(response){
			hideCover();
			$('#identifiers_modal_body_acc').html(response);
			$('#identifiers_modal_acc').modal();
		}
	});

});


$(document).delegate(".update_uid_button", "click", function(e) {
	
	showCover('Updating UID');

	var cur_id = e.currentTarget.id;
	cur_id = cur_id.replace('uid_button','');
	var cur_id_selector = '#uid'+cur_id;
	var color_selector = '#cid'+cur_id;
	var item_id = e.currentTarget.dataset.item_id;
	var branch_id = e.currentTarget.dataset.branch_id;

  	$.ajax({				
		type : 'POST',
		url  : 'update_uid',
		data : {'id': cur_id, 'uid' : $(cur_id_selector).val(), 'color': $(color_selector).val(), item_id,branch_id},
		success : function(response){
			hideCover();

			response = JSON.parse(response);

			if(response.success == 'true' || response.success == true)
			{
				alertify.success(response.message);
			}
			else
			{
				alertify.error(response.message);
			}

			
		}
	});

});


$(document).delegate(".remove_uid_button", "click", function(e) {
	showCover('Removing UID');

	var cur_id = e.currentTarget.id;
	cur_id = cur_id.replace('uidd_button','');

	var tr_id = '#uid_tr'+cur_id;

  	$.ajax({				
		type : 'POST',
		url  : 'delete_uid',
		data : {'id': cur_id},
		success : function(response){
			hideCover();

			response = JSON.parse(response);

			if(response.success == 'true' || response.success == true)
			{
				$(tr_id).remove();
				alertify.success(response.message);
			}
			else
			{
				alertify.error(response.message);
			}

			
		}
	});


});

//Scanning QRCODE


function scanItems(){

	var scanning = true;
	var imei = "";
	var item_movement_id = $("#main_movement_id").val();
	
	$(document).keypress(function (e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		imei += String.fromCharCode(code);
        if(code == 13){
    		if(scanning){
    			
    			if(imei == "" || imei.length <=1){
    				imei = $("#e-identifier").val();
    			}
	        	$.ajax({
			  		type: 'post',
			  		url: 'add_item_in_movement_thru_scanning',
			  		data:{imei,item_movement_id},
			  		beforSend:function(){
		  				scanning = false;
		  			},
			  		success:function(response){
			  			response = JSON.parse(response);
						if(response.success == 'true' || response.success == true)
						{
							alertify.success(response.message);
							$("#e-identifier").val('');
							setTimeout(function(){ scanning = true;; }, 1000);
						}
						else
						{
							setTimeout(function(){ scanning = true;; }, 1000);
							alertify.error(response.message);
						}
						imei = "";
			  		}
			  	}); 
        	}else{
				imei = "";
				$("#e-identifier").val('');
        	}
	    }
	});
}