$('document').ready(function(){
	get_loading_content();
	get_units();
});


function get_units()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();

	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_units',
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
		get_units();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_units();
})


function set_handler()
{
	$('.update').click(function(event){

		$('#error_message').addClass("hidden");

		showCover("Fetching record...");

		$.ajax({				
			type : 'GET',
			url  : 'get_unit/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#add_record_modal').modal();

				var result = JSON.parse(response);

				$('#id').val(result.id);
				$('#item_unit').val(result.unit);
				$('#description').val(result.description);
			}
		});

	});


	$('.remove').click(function(event){

		var id = event.currentTarget.id;

		alertify.confirm("Ooops!",'are you sure you want to delete this item unit?',
			function(){

				showCover("Deleting record...");

				$.ajax({				
					type : 'GET',
					url  : 'remove_unit/'+event.currentTarget.id,
					data : '',
					success : function(response){
						hideCover();

						var result = JSON.parse(response);

						if(result.success===true)
						{
							alertify.success(result.message);
						}

						get_units();
					}
				});
			},
			function(){
			}
		);
	});
}



$('#add_record_form').submit(function(event){
		event.preventDefault();

        $('#form-loading').removeClass("hidden");

        save_record($(this));

});

function save_record(form){
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
            		alertify.success('new item unit added');
            	}

            	$('#error_message').addClass("hidden");

            	get_units();
            }

    });
}

