$('document').ready(function(){
	get_loading_content();
	get_categories();
});


function get_categories()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();

	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_categories',
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
		get_categories();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_categories();
})


function set_handler()
{
	$('.update').click(function(event){

		$('#error_message').addClass("hidden");

		showCover("Fetching record...");

		var category_id = event.currentTarget.id;

		get_parent_category_options(category_id);

	});


	$('.remove').click(function(event){

		var id = event.currentTarget.id;

		alertify.confirm("Ooops!",'are you sure you want to delete this item category?',
			function(){

				showCover("Deleting record...");

				$.ajax({				
					type : 'GET',
					url  : 'remove_category/'+event.currentTarget.id,
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

						get_categories();
					}
				});
			},
			function(){
			}
		);
	});
}



$('#add_record_form').submit(function(event)
{
		event.preventDefault();

        $('#form-loading').removeClass("hidden");

        save_record($(this));

});


$('#add_record_trigger').click(function(event)
{
	get_parent_category_options(event.currentTarget.id);
});

function get_parent_category_options(id)
{
	$('#parent_category_id').html('');
	$("#parent_category_id").append('<option value="">Select parent category</option>');
	$("#parent_category_id").append('<option value="0">No Parent</option>');

	var data = "";

	if(isNaN(parseInt(id))){
		data='category=none';
	}else{
		data='category='+id;
	}
	$.ajax({				
		type : 'POST',
		url  : 'get_parent_category_options',
		data : data,
		success : function(response){
			var options = JSON.parse(response);
			for(var a = 0; a< options.length; a++)
			{
				$("#parent_category_id").append('<option value="'+options[a].id+'">'+options[a].category_string+'</option>');
			}


			$.ajax({				
				type : 'GET',
				url  : 'get_category/'+id,
				data : '',
				success : function(response){
					hideCover();
					$('#add_record_modal').modal();

					var result = JSON.parse(response);
					//fill up the modal form
					console.log(result);

					$('#id').val(result.id);
					$('#parent_category_id').val(result.parent_category).change();
					$('#category').val(result.category);
					$('#sequence').val(result.sequence_number);
				}
			});


		}
	});
}

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

            	get_categories();
            }

    });
}

