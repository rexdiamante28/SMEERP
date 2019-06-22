$(document).ready(function(){

		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	    ////////////////////////////////////////////////////////////////Data Loading///////////////////////////////////////////////////////////////////////
	    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	load_people = function() {

		var data = {
			"search_string" : $('#people_searchtext').val()
		};
		
		dataTable = $('#people-table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/people/table_data", // json datasource
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
			   { orderable: false, "targets": [ 6 ] },
			   { className: "text-center", "targets": [ 6 ] }
			 ]
		});
	}


	load_people();


	$('#people_search_form').submit(function(e){
		e.preventDefault();
		load_people();
	});

		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	    ////////////////////////////////////////////////////////////////Specific Data Loading///////////////////////////////////////////////////////////////
	    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$(document).delegate('.people_btn_view','click',function(e){
			showCover('Loading data...');
			$.ajax({
		        type:'get',
		        url:base_url+'app/people/read/'+e.currentTarget.id,
		        data:'',
		        success:function(data){
		        	hideCover();
		        	var json_data = JSON.parse(data);
		        	console.log(json_data);

		        	$('#people_create_form')[0].reset();

					$('#people_primary').val(json_data.id);
					$('#people_fname').val(json_data.fname);
					$('#people_mname').val(json_data.mname);
					$('#people_lname').val(json_data.lname);
					$('#people_contact').val(json_data.contact_number);
					$('#people_address').val(json_data.address);
					// $('#people_industry').val(json_data.industry).trigger('change');


					$('#people_create_modal').modal();
					

		        },
		        error: function(error){
		        	hideCover();
		        	sys_toast_error(error.responseText);
		        }
		    });
		});

});
