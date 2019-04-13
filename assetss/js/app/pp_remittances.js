	$(document).ready(function(){

		loaded_transactions = [];
		imageBlob = '';

		fillDataTable = function(searchstring) {

			var data = {
				'remittances_status': $('#remittance_status_dropdown').val(),
				'date_start': $('#date_start').val(),
				'date_end': $('#date_end').val(),
				'search_string': searchstring
			}

			dataTable = $('#table-grid').DataTable({
				destroy: true,
				"processing" : true,
				"serverSide": true,
				responsive: true,
				"ajax":{
					url:base_url+"app/transactions/pp_remittances_table", // json datasource
					type: "post",  // method  , by default get
					data: data,
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
						$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
						$("#table-grid_processing").css("display","none");
						$('.btnExcel').hide();
					}
				},
				"columnDefs": [
					//{ className: "text-center", "targets": [6,7,8,9] },
					//{ orderable: false, "targets": [ 6,9 ] }
				]
			});
		}



		function get_date()
		{
			showCover("Loading date...");
			$.ajax({
		  		type: 'get',
		  		url: base_url+'sys/settings/get_date/',
		  		data: '',
		  		contentType: false,   
				cache: false,      
				processData:false,
		  		success:function(data){
		  			hideCover();

		  			$('#date_start').val(data);
		  			$('#date_end').val(data);

		  			fillDataTable($('#search_text').val());
		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}
		
		
		get_date();


		$('#search_btn').click(function(){
			fillDataTable($('#search_text').val());
		});

		$('#reset_btn').click(function(){
			$('#search_text').val('');
			$('#date_start').val('');
			$('#date_end').val('');

			fillDataTable($('#search_text').val());
		});


		function draw_transaction_view(data){
			$('#remittance_view_modal_body').html(data);
		}

		function get_transaction_details(remittance_id)
		{
			showCover("Loading transaction information...");
			$.ajax({
		  		type: 'get',
		  		url: base_url+'app/transactions/get_remittance_details/'+remittance_id,
		  		data: '',
		  		contentType: false,   
				cache: false,      
				processData:false,
		  		success:function(data){
		  			var json_data = JSON.parse(data);
		  			sys_log(json_data.environment,json_data);
		  			hideCover();

		  			draw_transaction_view(json_data.message);
		  			$('#remittance_view_modal').modal();
		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}

		$(document).delegate('.view_transaction','click',function(e){
			get_transaction_details(e.currentTarget.id);
		});


		$('#add_btn').click(function(){
			$('#btn_save_remittance').addClass('hidden');
			$('#proceed_1').removeClass('hidden');
			loaded_transactions = [];
			$('#pg_1').show();
			$('#pg_2').hide();

			$('#remittance_add_modal').modal();
		});


		function get_covered_transactions()
		{
			var post_data = {
				'date_from' : $('#date_from').val(),
				'date_to'   : $('#date_to').val(),
				'merchant_id': $('#merchant_select').val()
			}


			showCover("Loading covered transactions...");
			$.ajax({
		  		type: 'post',
		  		url: base_url+'app/transactions/get_covered_transactions/',
		  		data: post_data,
		  		success:function(data){
		  			var json_data = JSON.parse(data);
		  			sys_log(json_data.environment,json_data);
		  			hideCover();

		  			if(json_data.success==true)
		  			{
		  				$('#pg_2').html(json_data.message);
		  				loaded_transactions = json_data.raw_message;

		  				$('#btn_save_remittance').removeClass('hidden');
						$('#proceed_1').addClass('hidden');

						$('#pg_1').hide();
						$('#pg_2').show();

		  			}
		  			else
		  			{
		  				sys_toast_warning(json_data.message);
		  			}

		  		},
		  		error: function(error){
		  			sys_toast_error('Something went wrong. Please try again.');
		  		}
		  	});
		}

		$('#proceed_1').click(function(){
			get_covered_transactions();
		});



		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$('#slip-placeholder').click(function(e){
			$('#slip_image').click();
		});


		$('#slip_preview').click(function(e){
			$('#slip_image').click();
		});

		$(document).on("imageResized", function (event) {
		    if (event.blob && event.url) {
		        imageBlob = event.blob;
		    }
		});


		function upload_slip(form)
		{
			postdata = new FormData(form[0]);
			postdata.append('image_resized', imageBlob);
			postdata.append('loaded_transactions', JSON.stringify(loaded_transactions));
			postdata.append('total_amount_received', $('#f_total_amount_received').val());
			postdata.append('reason',  $('#f_remarks').val());

			showCover("Saving Remittance Bill...");

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
							$('#remittance_bill_form')[0].reset();
							$('#remittance_add_modal').modal('hide');

							//$('input[name='+json_data.csrf_name+']').val(json_data.csrf_hash);
							sys_toast_success(json_data.message);
							fillDataTable($('#search_text').val());
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


		$('#slip_image').change(function() {
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
				        	$('#slip_preview').attr('src', readerEvent.target.result);
				        	$('#slip_preview').removeClass("hidden");
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

				    $('#slip-placeholder').addClass('hidden');
			    }
			    catch(error){
			    	console.log(error.message);
			    }
	        }

		 });



		$('#merchant_select').change(function(e){

			var merchant_id = $('#merchant_select').val();

			if(merchant_id!="")
			{
				showCover("Loading merchant bank accounts...");
				$.ajax({
			  		type: 'get',
			  		url: base_url+'app/merchant/get_bank_accounts_select/'+merchant_id,
			  		data: '',
			  		contentType: false,   
					cache: false,      
					processData:false,
			  		success:function(data){
			  			//var json_data = JSON.parse(data);
			  			//sys_log(json_data.environment,json_data);
			  			hideCover();
			  			$('#bank_select').html(data);

			  		},
			  		error: function(error){
			  			sys_toast_error('Something went wrong. Please try again.');
			  		}
			  	});
			}
			
		})


		$('#remittance_bill_form').submit(function(event){

			event.preventDefault();
			
			if(loaded_transactions.length>0)
			{
				var form = $(this);
		        upload_slip(form);
			}
			else
			{
				$('#btn_save_remittance').addClass('hidden');
				$('#proceed_1').removeClass('hidden');
				loaded_transactions = [];
				$('#pg_1').show();
				$('#pg_2').hide();

				sys_toast_warning("No transaction was covered. Please select a different date range.");
			}
			
		});


		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


});