$('document').ready(function(){
	get_loading_content();
	get_notifications();
});


function get_notifications()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();


	data = 'search='+search+'&record_per_page='+record_per_page;


	$.ajax({				
		type : 'POST',
		url  : 'get_notifications',
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

		get_notifications();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_notifications();
})


function set_handler()
{
	$('.read').click(function(event){

		$.ajax({				
			type : 'GET',
			url  : 'set_read/'+event.currentTarget.id,
			data : '',
			success : function(response){

				var result = JSON.parse(response);
				get_notifications();
			}
		});

	});


	$('.important').click(function(event){
		
		$.ajax({				
			type : 'GET',
			url  : 'toggle_important/'+event.currentTarget.id,
			data : '',
			success : function(response){

				var result = JSON.parse(response);
				get_notifications();
			}
		});
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
            		alertify.success('new brach added');
            	}

            	$('#error_message').addClass("hidden");

            	get_notifications();
            }

    });
}

