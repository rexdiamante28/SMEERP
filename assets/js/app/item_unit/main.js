$(document).ready(function(){

	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Data Loading///////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	load_item_units = function() {

		var data = {
			"search_string" : $('#item_unit_searchtext').val()
		};
		
		dataTable = $('#item_unit-table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/item_unit/table_data", // json datasource
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


	load_item_units();


	$('#item_unit_search_form').submit(function(e){
		e.preventDefault();
		load_item_units();
	});





	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////Specific Data Loading///////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$(document).delegate('.item_unit_btn_view','click',function(e){
		showCover('Loading data...');
		$.ajax({
	        type:'get',
	        url:base_url+'app/item_unit/read/'+e.currentTarget.id,
	        data:'',
	        success:function(data){
	        	hideCover();
	        	var json_data = JSON.parse(data);
	        	console.log(json_data);

	        	$('#item_unit_create_form')[0].reset();

				$('#item_unit_primary').val(json_data.id);
				$('#item_unit_company').val(json_data.company_name);
				$('#item_unit_company').attr('data-id',json_data.company);
				$('#item_unit_name').val(json_data.name);
				$('#item_unit_description').val(json_data.description);

				$('#item_unit_create_modal').modal();
				

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
	$(document).delegate('.item_unit_btn_delete','click',function(e){

		var id = e.currentTarget.id;

		alertify.confirm("Confirmation",'are you sure you want to delete this record?',
			function(){
				showCover('Deleting data...');
				$.ajax({
			        type:'get',
			        url:base_url+'app/item_unit/delete/'+id,
			        data:'',
			        success:function(data){
			        	hideCover();
			        	var json_data = JSON.parse(data);

			        	if(json_data.success)
			        	{
			        		sys_toast_success(json_data.message);
			        		load_item_units();
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

	var options = {
		url: function(phrase) {
			return base_url+"app/company/company_json/"+$('#item_unit_company').val();
		},
		getValue: "name",
		list: {

			onSelectItemEvent: function() {
				var value = $("#item_unit_company").getSelectedItemData().id;
				$("#item_unit_company").attr('data-id',value);
			}
		}
	};

	$("#item_unit_company").easyAutocomplete(options);
  

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////Additional functions end/////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

});
