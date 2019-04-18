$(document).ready(function(){

	searchstring = "";
	imageBlob = '';

	fillDataTable = function() {
		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"sys/users/users_list_table", // json datasource
				type: "post",  // method  , by default get
				data: {'searchstring': searchstring },
				beforeSend:function(data){
					showCover("loading list...");
				},
				complete: function(data)
				{	
					hideCover();
					var response = $.parseJSON(data.responseText);
					console.log(response);
				},
				error: function(){  // error handling
					hideCover();
					$(".table-grid-error").html("");
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
				}
			}/*,
			"columnDefs": [
			   { className: "ap-t", "targets": [ 3,4 ] },
			   { className: "dp-t", "targets": [ 5,6,7,8,9,10 ] }
			 ]*/
		});
	}


	
	fillDataTable(searchstring);


	$('#searchBtn').click(function(){
		searchstring = $('#searchtext').val();
		fillDataTable(searchstring);
	});


	$('#newuser_btn').click(function(){
		$('#addusermodal').modal();
	});


	$(document).on("imageResized", function (event) {
	    if (event.blob && event.url) {
	        imageBlob = event.blob;
	    }
	});

	$('#avatar-placeholder').click(function(){
		$('#avatar_image').click();
	});



	function upload_logo(form)
	{
		postdata = new FormData(form[0]);
		postdata.append('item_image', imageBlob);

		showCover("Uploading logo...");

		$.ajax({				
				url: form.attr("action"),
		       	type: form.attr("method"),
				data: postdata,
				contentType: false,   
				cache: false,      
				processData:false,
			success : function(data){
					json_data = JSON.parse(data);
					sys_log(json_data);

					if(json_data.success == true)
					{
						$('#avatar_preview').prop("src",base_url+"assets/uploads/"+json_data.filename);
						$('#user_form')[0].reset();
						$('#addusermodal').modal('hide');

						$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
						sys_toast_success(json_data.message);
						fillDataTable(searchstring);
					}
					else
					{
						sys_toast_warning_info(json_data.message);
						$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
					}
					
					hideCover();
					//sys_toast_success(json_data.message);

			},
			error : function(error){
				sys_toast_error(error.responseText);
			}
		});
	}


	var dataURLToBlob = function(dataURL) {
	    var BASE64_MARKER = ';base64,';
	    if (dataURL.indexOf(BASE64_MARKER) == -1) {
	        var parts = dataURL.split(',');
	        var contentType = parts[0].split(':')[1];
	        var raw = parts[1];

	        return new Blob([raw], {type: contentType});
	    }

	    var parts = dataURL.split(BASE64_MARKER);
	    var contentType = parts[0].split(':')[1];
	    var raw = window.atob(parts[1]);
	    var rawLength = raw.length;

	    var uInt8Array = new Uint8Array(rawLength);

	    for (var i = 0; i < rawLength; ++i) {
	        uInt8Array[i] = raw.charCodeAt(i);
	    }

	    return new Blob([uInt8Array], {type: contentType});
	}

	$('#avatar_image').change(function() {

		var fileInput = $(this);
		var input = this;

		var file = fileInput[0].files[0];

	    try{
	    	// Ensure it's an image
		    if(file.type.match(/image.*/)) {
		        // Load the image
		        var reader = new FileReader();
		        reader.onload = function (readerEvent) {
		        	//console.log(readerEvent.target.result);
		        	$('#avatar_preview').attr('src', readerEvent.target.result);
		            var image = new Image();
		            image.onload = function (imageEvent) {
		                // Resize the image
		                var canvas = document.createElement('canvas'),
		                    max_size = 300,
		                    width = image.width,
		                    height = image.height;
		                if (width > height) {
		                    if (width > max_size) {
		                        height *= max_size / width;
		                        width = max_size;
		                    }
		                } else {
		                    if (height > max_size) {
		                        width *= max_size / height;
		                        height = max_size;
		                    }
		                }
		                canvas.width = width;
		                canvas.height = height;
		                canvas.getContext('2d').drawImage(image, 0, 0, width, height);
		                var dataUrl = canvas.toDataURL('image/jpeg');
		                var resizedImage = dataURLToBlob(dataUrl);
		                $.event.trigger({
		                    type: "imageResized",
		                    blob: resizedImage,
		                    url: dataUrl
		                });

		                //console.log(width+"  "+height);
		            }
		            image.src = readerEvent.target.result;
		        }
		        reader.readAsDataURL(file);
		    }

		    $('#avatar-placeholder').addClass('hidden');
	    }
	    catch(error){
	    	console.log(error.message);
	    }

	 });


	$('#user_form').submit(function(event){
			event.preventDefault();
			var form = $(this);
	        upload_logo(form);
	});

	$('#initiate_btn').click(function(e){
		$('#user_form').submit();
	});


	$('#passwordunmask_btn').mousedown(function(){
		$('#f_password').attr('type','text');
	});

	$('#passwordunmask_btn').mouseup(function(){
		$('#f_password').attr('type','password');
	});

	$(document).delegate('.view_merchant','click',function(e){
		showCover("Loading details...");
		$.ajax({
	        type:'get',
	        url:base_url+'app/merchant/get_merchant_details/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);
	        	populate_edit_form(json_data.message);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});

	function populate_edit_form(data)
	{

		$('#avatar-placeholder').addClass('hidden');


		$('#f_id').val(data.id);
		$('#avatar_preview').attr('src',base_url+'assets/uploads/merchantlogos/'+data.logo);
		$('#f_merchant_id').val(data.merchant_id);
		$('#f_merchant_name').val(data.merchant_name);
		$('#f_return_url').val(data.return_url);
		$('#f_details_url').val(data.details_url);
		$('#f_postback_url').val(data.postback_url);
		$('#f_email').val(data.username);
		$('#f_password').val(data.password);
		$('#f_secret_key').val(data.secret_key);
		$('#f_ip_address').val(data.ip);
		$('#f_merchant_status').val(data.status);
		$('#f_reference_number_label').val(data.ref_label);
		$('#f_name_label').val(data.name_label);

		$('#addusermodal').modal();
	}

});
