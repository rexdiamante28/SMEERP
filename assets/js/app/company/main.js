$(document).ready(function(){

	load_companies = function() {

		var data = {
			"search_string" : $('#company_searchtext').val()
		};
		
		dataTable = $('#company-table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/company/table_view", // json datasource
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


	load_companies();


	$('#searh_form').submit(function(){
		load_companies();
	});

});
