$('document').ready(function(){
	get_loading_content();
	get_users();
});


function get_users()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();

	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_users',
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
		get_users();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_users();
})


function set_handler()
{
	$('.update').click(function(event){

		$('#error_message').addClass("hidden");

		showCover("Fetching record...");

		$.ajax({				
			type : 'GET',
			url  : 'get_user/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#add_record_modal').modal();

				var result = JSON.parse(response);
				//fill up the modal form
				console.log(result);

				$('#id').val(result.id);
				$('#branches_list').val(result.branches);
				$('#functions_list').val(result.functions);
				$('#username').val(result.username);
				$('#first_name').val(result.first_name);
				$('#middle_name').val(result.middle_name);
				$('#last_name').val(result.last_name);
				$('#telephone_number').val(result.telephone_number);
				$('#mobile_number').val(result.mobile_number);
				$('#email_address').val(result.email_address);
				$('#status').val(result.status).change();
				$('#image_name').val(result.avatar);

				var url =  imgurl;
				url = url.replace('user-avatar.jpg',result.avatar);
				$('#img_preview').attr('src', url);

				//check the checkboxes
				//uncheck first
				$('#branches_options input:checkbox').prop("checked", false);

				if(result.branches!==''&& result.branches!== null)
				{
					var branches_assignments = result.branches.split(',');
					for(var a = 0; a<branches_assignments.length; a++)
					{	
						var query="#branches_options input:checkbox[value="+branches_assignments[a]+"]";
						$(query).prop("checked", true);
					}
				}

				$('#function_options_div input:checkbox').prop("checked", false);
				if(result.functions!==''&& result.functions!== null)
				{
					var functions = result.functions.split(',');
					for(var a = 0; a<functions.length; a++)
					{	
						var query="#function_options_div input:checkbox[value='"+functions[a]+"']";
						$(query).prop("checked", true);
					}
				}
			}
		});

	});


	$('.remove').click(function(event){

		var id = event.currentTarget.id;

		alertify.confirm("Ooops!",'are you sure you want to delete this storage location?',
			function(){

				showCover("Deleting record...");

				$.ajax({				
					type : 'GET',
					url  : 'remove_location/'+event.currentTarget.id,
					data : '',
					success : function(response){
						hideCover();

						var result = JSON.parse(response);

						if(result.success===true)
						{
							alertify.success(result.message);
						}

						get_users();
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
            		alertify.success('new storage location added');
            	}

            	$('#error_message').addClass("hidden");

            	get_users();
            }

    });
}

$('.branch_option').click(function(){
	var branchIds = $("#branches_options input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
    $('#branches_list').val(branchIds);
})

$('.function_option').click(function(){
	var functions = $("#function_options_div input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
    $('#functions_list').val(functions);
})



function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_preview').attr('src', e.target.result);
            $('#uploadbutton').removeClass("hidden");
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$('#item_image').change(function() {
    var fileInput = $(this);
    var input = this;

    if (fileInput.length && fileInput[0].files && fileInput[0].files.length) {
      var url = window.URL || window.webkitURL;
      var image = new Image();
      image.onload = function() {
        readURL(input);
      };
      image.onerror = function() {
        alertify.error('Please select a valid image ');
        $('#uploadbutton').addClass("hidden");
        $('#upload_image_form')[0].reset();
        $('#img_preview').attr('src', imgurl);
      };
      image.src = url.createObjectURL(fileInput[0].files[0]);
    }
  });


$('#img_preview').click(function(event){
	$('#item_image').click();
})

imgurl = "";

$(document).ready(function(){
	imgurl = $('#img_preview').attr('src');
})

$('#add_record_trigger').click(function(){
	$('#uploadbutton').addClass("hidden");
	$('#upload_image_form')[0].reset();
	$('#img_preview').attr('src', imgurl);
	$('#upload-loading').addClass('hidden');
	$('#function_options_div input:checkbox').prop("checked", false);
	$('#branches_options input:checkbox').prop("checked", false);
});



$('#upload_image_form').submit(function(event){
		event.preventDefault();

		$('#upload-loading').removeClass('hidden');
        var form = $(this);

        $.ajax({				
				url: form.attr('action'),
	        	type: form.attr('method'),
				data: new FormData(form[0]),
				contentType: false,   
				cache: false,      
				processData:false,
			success : function(data){
				var response = (JSON.parse(data));
				if(response.error){
					alertify.error(response.error);

					$('#uploadbutton').addClass("hidden");
			        $('#upload_image_form')[0].reset();
			        $('#img_preview').attr('src', imgurl);
			        $('#upload-loading').addClass('hidden');
				}
				else if(response.upload_data){
					alertify.success("Upload successful");
					$('#image_name').val(response.upload_data.file_name);

					$('#uploadbutton').addClass("hidden");
			        $('#upload_image_form')[0].reset();
			        $('#upload-loading').addClass('hidden');
				}
			},
			error : function(error){
				alertify.error(error);
				$('#uploadbutton').addClass("hidden");
		        $('#upload_image_form')[0].reset();
		        $('#img_preview').attr('src', imgurl);
		        $('#upload-loading').addClass('hidden');
			}
		});
});
