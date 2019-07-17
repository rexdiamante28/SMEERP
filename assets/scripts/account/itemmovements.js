
$('document').ready(function(){
	get_loading_content();
	get_item_movements();
});


function get_item_movements()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();

	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_item_movements',
		data : data,
		success : function(response){		
			$('#x_content').html(response);
			set_handler();
		}
	});
}

$('#search_form').submit(function(event){
		event.preventDefault();
		$('#x_content').html(loading_content);
		get_item_movements();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_item_movements();
})


function set_handler()
{
	$('.update').click(function(event){

		$('#error_message').addClass("hidden");

		showCover("Fetching record...");
		var movement_id = event.currentTarget.id;

		$.ajax({				
			type : 'GET',
			url  : 'get_stock_movement/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#add_record_modal').modal();

				var result = JSON.parse(response);
				//fill up the modal form

				$('#id').val(result.id);
				$('#branch_id').val(result.branch_id).change();
				$('#facilitator').val(result.facilitator).change();
				$('#code').val(result.code);
				$('#date').val(result.date);
				$('#type').val(result.type);
				$('#status').val(result.status).change();
				$('#internal_notes').val(result.internal_notes);

			}
		});

	});


	$('.remove').click(function(event){

		var id = event.currentTarget.id;

		alertify.confirm("Ooops!",'are you sure you want to delete this item movement?',
			function(){

				showCover("Deleting record...");

				$.ajax({				
					type : 'GET',
					url  : 'remove_item_movement/'+event.currentTarget.id,
					data : '',
					success : function(response){
						hideCover();

						var result = JSON.parse(response);

						if(result.success===true)
						{
							alertify.success(result.message);
						}
						else
						{
							alertify.error(result.message);
						}

						get_item_movements();
					}
				});
			},
			function(){
			}
		);
	});


	$('.details').click(function(){

		showCover("Fetching record...");
		console.log(event);
		$('#add_item_in_movement_details_form #movement_id').val(event.currentTarget.id);
		$('#add_item_in_movement_details_form #movement_type').val(event.currentTarget.getAttribute('data-movement_type'));

		$.ajax({				
			type : 'GET',
			url  : 'get_stock_movement_items/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#details_modal').modal();
				$('#details_modal_content').html(response);

			}
		});

	});


	$('.details-inb').click(function(){

		showCover("Fetching record...");

		$('#add_item_in_movement_details_form #movement_id').val(event.currentTarget.id);

		$.ajax({				
			type : 'GET',
			url  : 'get_stock_movement_items/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#details_modal_inb').modal();
				$('#details_modal_content_inb').html(response);

			}
		});

	});	

	$('.details-acc').click(function(){

		showCover("Fetching record...");

		$('#add_item_in_movement_details_form #movement_id').val(event.currentTarget.id);

		$.ajax({				
			type : 'GET',
			url  : 'get_stock_movement_items/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#details_modal_accepted').modal();
				$('#details_modal_content_acc').html(response);

			}
		});

	});
}



$('#add_record_form').submit(function(event)
{
		event.preventDefault();

        $('#form-loading').removeClass("hidden");

        save_record($(this));

});



function save_record(form)
{
    $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: form.attr('method')
        }).done(function(response) {

            $('#form-loading').addClass("hidden");

            var response = JSON.parse(response);

            if(response.success===false)
            {
            	$('#error_message').removeClass('hidden');
            	$('#error_message').html(response.message);
            }
            else
            {
            	//alert(response.message);
            	$('#add_record_form')[0].reset();
            	$('#close_modal').click();

            	if(isNaN(parseInt(response.message)))
            	{
            		alertify.success(response.message);
            	}
            	else
            	{
            		alertify.success('new storage location added');
            	}

            	$('#error_message').addClass("hidden");

            	get_item_movements();
            }

    });
}


$('#branch_id').change(function(){
	get_facilitators();
});

function get_facilitators(){
	showCover("Fetching facilitator options...");

	$('#facilitator').html('');
	$("#facilitator").append('<option value="" selected disabled >Select Facilitator</option>');

	var branch_id = $('#branch_id').val();

	var data = 'branch_id='+branch_id;

	$.ajax({				
		type : 'POST',
		url  : 'get_facilitators/',
		data : data,
		success : function(response){

			var options = JSON.parse(response);
			for(var a = 0; a< options.length; a++)
			{
				$("#facilitator").append('<option value="'+options[a].id+'">'+options[a].name+'</option>');
			}

			hideCover();
		}
	});
}

	//ADDED FUNCTIONS
	$('#type').change(function(){
		var from_id = $("#branch_id option:selected").val();

		if($(this).val() == "Outbound"){

			$("#move_to_branch").prop("hidden", false);
			$("#branch_id2 option[value="+from_id+"]").prop("hidden", true);

		}else{
			$("#move_to_branch").prop("hidden", true);
		}
	});

	$('#accept_oub_to_inb').click(function(e){
		$('#details_modal_inb_accept').modal();
	});

	$('#accept_oub_to_inb_confirm').click(function(e){

		var thiss = $(this);
		var inbound_id = $('#add_item_in_movement_details_form #movement_id').val();
		$.ajax({				
			type : 'POST',
			url  : 'import_item_out_to_inbound',
			data : {'inbound_id': inbound_id},
			beforeSend: function(){
				thiss.prop("disabled", true);
			},
			success : function(response){
				hideCover();

				response = JSON.parse(response);

				if(response.success == 'true' || response.success == true)
				{
					alertify.success(response.message);
					$('#details_modal_inb').modal('toggle');
					$('#details_modal_inb_accept').modal('toggle');
					location.reload();
				}
				else
				{
					thiss.prop("disabled", false);
					alertify.error(response.message);
				}

				
			}
		});
	});

