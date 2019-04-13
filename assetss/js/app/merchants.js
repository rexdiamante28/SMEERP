$(document).ready(function(){

	searchstring = "";
	imageBlob = '';

	fillDataTable = function() {

		var data = {

		};
		
		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/merchant/merchant_list_table", // json datasource
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
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
					$('.btnExcel').hide();
				}
			},
			"columnDefs": [
			   { orderable: false, "targets": [ 3 ] }
			 ]
		});
	}


	
	fillDataTable(searchstring);


	$('#searchBtn').click(function(){
		searchstring = $('#searchtext').val();
		fillDataTable(searchstring);
	});


	$('#newmerchant_btn').click(function(){
		$('#merchant_form')[0].reset();
		$('#addmerchantmodal').modal();
		$('#logo-placeholder').removeClass("hidden");
		$('#logo_preview').addClass("hidden");
	});


	$(document).on("imageResized", function (event) {
	    if (event.blob && event.url) {
	        imageBlob = event.blob;
	    }
	});

	$('#logo-placeholder').click(function(){
		$('#logo_image').click();
	});

	$('#logo_preview').click(function(){
		$('#logo_image').click();
	});


	function upload_logo(form)
	{
		postdata = new FormData(form[0]);
		postdata.append('logo_image_resized', imageBlob);

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
						$('#logo_preview').prop("src",base_url+"assets/uploads/"+json_data.filename);
						$('#logo_preview').removeClass("hidden");
						$('#merchant_form')[0].reset();
						$('#addmerchantmodal').modal('hide');

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

	$('#logo_image').change(function() {

		var fileInput = $(this);
		var input = this;

		var goUpload = true;
		var file = fileInput[0].files[0];

		if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(file.name)) {
			sys_toast_warning('You must select an image file less than 2 MB in size');
			goUpload = false;
        }if (goUpload == true) {
           try{
           		console.log('went here');
		    	// Ensure it's an image
			    if(file.type.match(/image.*/)) {
			        // Load the image
			        var reader = new FileReader();
			        reader.onload = function (readerEvent) {
			        	//console.log(readerEvent.target.result);
			        	$('#logo_preview').attr('src', readerEvent.target.result);
			        	$('#logo_preview').removeClass("hidden");
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

			    $('#logo-placeholder').addClass('hidden');
		    }
		    catch(error){
		    	console.log(error.message);
		    }
        }

	 });


	$('#merchant_form').submit(function(event){
			event.preventDefault();
			var form = $(this);
	        upload_logo(form);
	});

	$('#initiate_btn').click(function(e){
		$('#merchant_form').submit();
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
	        	get_merchant_bank_accounts();
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


	function get_token()
	{
		showCover("Processing...");
		$.ajax({
	  		type: 'get',
	  		url: base_url+'auth/authentication/get_token',
	  		data: '',
	  		contentType: false,   
			cache: false,      
			processData:false,
	  		success:function(data){
	  			var json_data = JSON.parse(data);
	  			sys_log(json_data.environment,json_data);
	  			hideCover();

	  			ajax_token_name = json_data.data.csrf_name;
	  			ajax_token = json_data.data.csrf_hash;

	  			add_bank_account();

	  		},
	  		error: function(error){
	  			sys_toast_error('Something went wrong. Please try again.');
	  		}
	  	});
	}


	function populate_edit_form(data)
	{

		$('#logo-placeholder').addClass('hidden');


		$('#f_id').val(data.id);
		$('#logo_preview').attr('src',base_url+'assets/uploads/merchantlogos/'+data.logo);
		$('#logo_preview').removeClass("hidden");
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
		$('#f_fees_online_bank').val(data.online_bank_fee);
		$('#f_fees_otc_bank').val(data.otc_bank_fee);
		$('#f_fees_otc_non_bank').val(data.otc_non_bank_fee);

		$('#addmerchantmodal').modal();
	}


	$('#merchant_add_bank_account_btn').click(function(e){
		$('#add_bank_account_modal').modal();
	});



	function get_merchant_bank_accounts()
	{	

		var merchant_id = $('#f_id').val();

		showCover("Loading bank accounts...");
		$.ajax({
	        type:'get',
	        url: base_url+'app/merchant/get_bank_accounts/'+merchant_id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	
	        	$('#merchant_banks_table_body').html(data);
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	}


	function add_bank_account(){
		$('#add_bank_account_form').submit();
	}

	$('#initiate_bank_account_add_btn').click(function(){get_token();});


	$('#add_bank_account_form').submit(function(e){
		e.preventDefault();

		var form = $(this)[0];

		var data = {
			'bank_id' : $('#bank_account_options').val(),
			'account_number': $('#bank_account_number').val(),
			'merchant_id': $('#f_id').val(),
			[ajax_token_name]: ajax_token
		};

		console.log(data);

		showCover("Processing...");
		$.ajax({
	        type:'post',
	        url:form.action,
	        data:data,
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);

	        	if(json_data.success == true)
	        	{
	        		$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
	        		sys_toast_success(json_data.message);
	        		get_merchant_bank_accounts();
	        		$('#add_bank_account_modal').modal('hide');
	        		$('#add_bank_account_form')[0].reset();
	        		$('#add_bank_account_modal').modal('hide');
	        	}
	        	else
	        	{
	        		sys_toast_warning(json_data.message);
	        	}
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });

	});


	$(document).delegate('.btn_delete_bank_account','click',function(e){
		$('#bank_account_number_delete').val($(this).data('id'));
		$('#bank_account_delete_prompt_modal').modal();
	});


	$('#initiate_bank_account_delete_btn').click(function(){
		var account_id = $('#bank_account_number_delete').val();

		showCover("Deleting account...");
		$.ajax({
	        type:'get',
	        url: base_url+'app/merchant/delete_bank_account/'+account_id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	sys_log(json_data.environment,json_data);

	        	if(json_data.success == true)
	        	{
	        		sys_toast_success(json_data.message);
	        	}
	        	get_merchant_bank_accounts();
	        	$('#bank_account_delete_prompt_modal').modal('hide');
	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});


});
