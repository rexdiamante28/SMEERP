$('#add_item_in_movement_button').click(function(){
	get_items();
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
	$('.add_to_item_tigger').click(function(){
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
            console.log(response);

            if(response.success===false)
            {
            	$('#add_item_in_movement_details_form #error_message').removeClass('hidden');
            	$('#add_item_in_movement_details_form #error_message').html(response.message);
            }
            else
            {
            	//alert(response.message);
            	//$('#add_record_form')[0].reset();
            	//$('#close_modal').click();

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
  	$.ajax({				
		type : 'GET',
		url  : 'get_item_movement_item_uids/'+e.currentTarget.id,
		data : '',
		success : function(response){
			hideCover();
			$('#identifiers_modal_body').html(response);
			$('#identifiers_modal').modal();
		}
	});

});


$(document).delegate(".update_uid_button", "click", function(e) {
	showCover('Updating UID');

	var cur_id = e.currentTarget.id;
	cur_id = cur_id.replace('uid_button','');
	var cur_id_selector = '#uid'+cur_id;

  	$.ajax({				
		type : 'POST',
		url  : 'update_uid',
		data : {'id': cur_id, 'uid' : $(cur_id_selector).val()},
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