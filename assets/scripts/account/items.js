

$(document).ready(function(){
	get_loading_content();
	get_items();
});


function get_items()
{
	var data = '';
	var search = $('#search').val();
	var record_per_page = $('#record_per_page').val();


	data = 'search='+search+'&record_per_page='+record_per_page;

	$.ajax({				
		type : 'POST',
		url  : 'get_items',
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

		get_items();

});

$('#record_per_page').change(function(){
	$('#x_content').html(loading_content);
	get_items();
})


function set_handler()
{
	$('.update').click(function(event){

		$('#error_message').addClass("hidden");

		showCover("Fetching record...");

		$.ajax({				
			type : 'GET',
			url  : 'get_item/'+event.currentTarget.id,
			data : '',
			success : function(response){
				hideCover();
				$('#add_record_modal').modal();

				var result = JSON.parse(response);
				//fill up the modal form
				//console.log(result);

				$('#id').val(result.id);
				if(result.has_unique_identifier == '1')
				{
					$('#unique_identifier').prop('checked',true);
				}
				else
				{
					$('#unique_identifier').prop('checked',false);
				}
				$('#image_name').val(result.item_image);
				$('#item_category').val(result.item_category).change();
				$('#item_code').val(result.item_code);
				$('#bar_code').val(result.bar_code);
				$('#item_name').val(result.item_name);
				$('#price').val(parseFloat(result.price).toFixed(2));
				$('#generic_name').val(result.generic_name);
				$('#item_unit').val(result.item_unit).change();
				$('#status').val(result.status).change();
				$('#item_description').val(result.item_description);

				var url =  imgurl;
				url = url.replace('default.png',result.item_image);
				$('#img_preview').attr('src', url);

				console.log(url);
			}
		});

	});


	$('.remove').click(function(event){

		var id = event.currentTarget.id;

		alertify.confirm("Ooops!",'are you sure you want to delete this item?',
			function(){

				showCover("Deleting record...");

				$.ajax({				
					type : 'GET',
					url  : 'remove_item/'+event.currentTarget.id,
					data : '',
					success : function(response){
						hideCover();

						var result = JSON.parse(response);

						if(result.success===true)
						{
							alertify.success(result.message);
						}

						get_items();
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

        var form = $(this);

        $.ajax({
	            url: form.attr('action'),
	            type: form.attr('method'),
				data: form.serialize(),
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
	            		alertify.success('new item added');
	            	}

	            	$('#error_message').addClass("hidden");

	            	get_items();
	            }

	    });
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
});


$('#generate_barcode').click(function(){
	$.ajax({				
			url: base_url+'items/generate_barcode',
	       	type: 'post',
			data: '',
		success : function(data){
			$('#bar_code').val(data);
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