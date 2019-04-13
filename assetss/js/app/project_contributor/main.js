$(document).ready(function(){

	load_project_contributor_data = function() {

		var data = {};
		
		dataTable = $('#project_contributor_table_grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/project_contributor/list?project_id="+$('#view_project_project_id').val(), // json datasource
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
			   { orderable: false, "targets": [ 1 ] },
			   { className: "text-center", "targets": [ 5 ] }
			 ]
		});
	}


	$('#project_contributors_tab_btn').click(function(e){
		load_project_contributor_data();
	});



});
