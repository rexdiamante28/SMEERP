$(document).ready(function(){

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Data Loading///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	load_storage_locations = function() {

		var data = {
			"search_string" : $('#storage_location_searchtext').val()
		};
		
		dataTable = $('#storage_location-table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/storage_location/table_data", // json datasource
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
			   { orderable: false, "targets": [ 3 ] },
			   { className: "text-center", "targets": [ 3 ] }
			 ]
		});
	}


	load_storage_locations();


	$('#storage_location_search_form').submit(function(e){
		e.preventDefault();
		load_storage_locations();
	});



	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Specific Data Loading///////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$(document).delegate('.storage_location_btn_view','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/storage_location/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	console.log(json_data);

	        	$('#storage_location_create_form')[0].reset();

				$('#storage_location_primary').val(json_data.id);
				$('#storage_location_company').val(json_data.branch);
				/*prepare_branches_options(json_data.parent_category,json_data.id);*/
				prepare_branches_options(json_data.branch,0,json_data.parent_location,json_data.id);
				$('#storage_location_name').val(json_data.name);


				$('#storage_location_create_modal').modal();
				

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
	$(document).delegate('.storage_location_btn_delete','click',function(e){

		var id = e.currentTarget.id;

		alertify.confirm("Confirmation",'are you sure you want to delete this record?',
			function(){
				showCover('Deleting data...');
				$.ajax({
			        type:'get',
			        url:base_url+'app/storage_location/delete/'+id,
			        data:'',
			        success:function(data){
			        	hideCover();
			        	var json_data = JSON.parse(data);

			        	if(json_data.success)
			        	{
			        		sys_toast_success(json_data.message);
			        		load_storage_locations();
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

    function prepare_branches_options(autoselect_id=0,exclude_id=0,location_autoselect_id=0,location_exclude_id=0)
    {
    	var id = $('#storage_location_company').val();

    	if(id!="")
    	{
    		showCover('Loading options...');
			$.ajax({
			     type:'get',
			     url:base_url+'app/company/get_active_branches/'+id,
			     data:'',
			     success:function(data){
			     	hideCover();
			     	var json_data = JSON.parse(data);

			     	console.log(json_data);

			    	if(json_data.length > 0)
			    	{
			    		$('#storage_location_branch_group').removeClass('hidden');

			    		$("#storage_location_branch").html('');
			    		$("#storage_location_branch").append(new Option("-- Select Branch --", ""));

			    		for(var a=0; a< json_data.length; a++)
			    		{
			    			if(json_data[a].id!=exclude_id)
			    			{
			    				$("#storage_location_branch").append(new Option(json_data[a].branch, json_data[a].id));
			    			}
			    		}

			    		$('#storage_location_branch').val(autoselect_id);
			    	}
			    	else
			    	{
			    		$('#storage_location_branch_group').addClass('hidden');

			    		$("#storage_location_branch").html('');
			    		$("#storage_location_branch").append(new Option("-- Select Branch --", ""));
			    	}

			    	$('#storage_location_storage_location_group').addClass('hidden');

			    	$("#storage_location_parent_location").html('');
			    	$("#storage_location_parent_location").append(new Option("-- Select Parent Location --", "0"));

			    	prepare_locations_options(location_autoselect_id,location_exclude_id);

			    },
			    error: function(error){
			    	hideCover();
			    	sys_toast_error(error.responseText);
			    }
			});
    	}
    }

    $('#storage_location_company').change(function(e){
    	prepare_branches_options('',0,0,0);
    });


    function prepare_locations_options(autoselect_id=0,exclude_id=0)
    {
    	var id = $('#storage_location_branch').val();

    	if(id!="")
    	{
    		showCover('Loading options...');
			$.ajax({
			     type:'get',
			     url:base_url+'app/branch/get_active_locations/'+id,
			     data:'',
			     success:function(data){
			     	hideCover();
			     	var json_data = JSON.parse(data);

			     	console.log(json_data);

			    	if(json_data.length > 0)
			    	{
			    		$('#storage_location_storage_location_group').removeClass('hidden');

			    		$("#storage_location_parent_location").html('');
			    		$("#storage_location_parent_location").append(new Option("-- Select Parent Location --", "0"));

			    		for(var a=0; a< json_data.length; a++)
			    		{
			    			if(json_data[a].id!=exclude_id)
			    			{
			    				$("#storage_location_parent_location").append(new Option(json_data[a].location_string, json_data[a].id));
			    			}
			    		}

			    		$('#storage_location_parent_location').val(autoselect_id);
			    	}
			    	else
			    	{
			    		$('#storage_location_storage_location_group').addClass('hidden');

			    		$("#storage_location_parent_location").html('');
			    		$("#storage_location_parent_location").append(new Option("-- Select Parent Location --", "0"));
			    	}
			    },
			    error: function(error){
			    	hideCover();
			    	sys_toast_error(error.responseText);
			    }
			});
    	}
    }


    $('#storage_location_branch').change(function(e){
    	prepare_locations_options(0,0);
    });



    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Additional functions end/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
