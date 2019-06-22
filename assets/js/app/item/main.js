$(document).ready(function(){

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Data Loading///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	load_items = function() {

		var data = {
			"search_string" : $('#item_searchtext').val()
		};
		
		dataTable = $('#item-table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/item/table_data", // json datasource
				type: "get",  // method  , by default get
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
					//$(".table-grid-error").html("");
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
				}
			},
			"columnDefs": [
			   { orderable: false, "targets": [ 5 ] },
			   { className: "text-center", "targets": [ 5 ] }
			 ]
		});
	}


	load_items();

	$('#item_search_form').submit(function(e){
		e.preventDefault();
		load_items();
	});



	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Specific Data Loading///////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$(document).delegate('.item_btn_view','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/item/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	console.log(json_data);

	        	$('#item_create_form')[0].reset();

				$('#item_primary').val(json_data.id);
				$('#item_company').val(json_data.branch);
				prepare_categories_options(json_data.parent_category,json_data.id);
				prepare_categories_options(json_data.branch,0,json_data.parent_location,json_data.id);
				$('#item_name').val(json_data.name);


				$('#item_create_modal').modal();
				

	        },
	        error: function(error){
	        	hideCover();
	        	sys_toast_error(error.responseText);
	        }
	    });
	});



	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Specific Data Deleting/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$(document).delegate('.item_btn_delete','click',function(e){

		var id = e.currentTarget.id;

		alertify.confirm("Confirmation",'are you sure you want to delete this record?',
			function(){
				showCover('Deleting data...');
				$.ajax({
			        type:'get',
			        url:base_url+'app/item/delete/'+id,
			        data:'',
			        success:function(data){
			        	hideCover();
			        	var json_data = JSON.parse(data);

			        	if(json_data.success)
			        	{
			        		sys_toast_success(json_data.message);
			        		load_items();
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
			},
			function(){
			}
		);

	});


	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////Additional functions start//////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function prepare_categories_options(autoselect_id=0,exclude_id=0)
    {
    	var id = $('#item_company').val();

    	if(id!="")
    	{
    		showCover('Loading options...');
			$.ajax({
			     type:'get',
			     url:base_url+'app/item_category/get_company_categories/'+id,
			     data:'',
			     success:function(data){
			     	hideCover();
			     	var json_data = JSON.parse(data);

			     	console.log(json_data);

			    	if(json_data.length > 0)
			    	{
			    		$('#item_category_group').removeClass('hidden');

			    		$("#item_category").html('');
			    		$("#item_category").append(new Option("-- Select Catgeory --", "0"));

			    		for(var a=0; a< json_data.length; a++)
			    		{
			    			if(json_data[a].id!=exclude_id)
			    			{
			    				$("#item_category").append(new Option(json_data[a].category_string, json_data[a].id));
			    			}
			    		}

			    		$('#item_category').val(autoselect_id);

			    	}
			    	else
			    	{
			    		$('#item_category_group').addClass('hidden');

			    		$("#item_category").html('');
			    		$("#item_category").append(new Option("-- Select Catgeory --", "0"));
			    	}

			    },
			    error: function(error){
			    	hideCover();
			    	sys_toast_error(error.responseText);
			    }
			});
    	}
    }


    function prepare_item_units_options(autoselect_id=0,exclude_id=0)
    {
    	var id = $('#item_company').val();

    	if(id!="")
    	{
    		showCover('Loading options...');
			$.ajax({
			     type:'get',
			     url:base_url+'app/item_unit/get_company_item_units/'+id,
			     data:'',
			     success:function(data){
			     	hideCover();
			     	var json_data = JSON.parse(data);

			     	console.log(json_data);

			    	if(json_data.length > 0)
			    	{
			    		$("#item_unit").html('');
			    		$("#item_unit").append(new Option("-- Select Item Unit --", "0"));

			    		for(var a=0; a< json_data.length; a++)
			    		{
			    			if(json_data[a].id!=exclude_id)
			    			{
			    				$("#item_unit").append(new Option(json_data[a].name, json_data[a].id));
			    			}
			    		}

			    		$('#item_unit').val(autoselect_id);

			    		$('#item_unit_group').removeClass('hidden');

			    	}
			    	else
			    	{
			    		$('#item_unit_group').addClass('hidden');

			    		$("#item_unit").html('');
			    		$("#item_unit").append(new Option("-- Select Catgeory --", "0"));
			    	}

			    },
			    error: function(error){
			    	hideCover();
			    	sys_toast_error(error.responseText);
			    }
			});
    	}
    }

    $('#item_company').change(function(e){
    	prepare_categories_options(0,0);
    	prepare_item_units_options(0,0);
    });



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Additional functions end/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
