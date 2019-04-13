$(document).ready(function(){


	fillDataTable = function() {

		var data = {
			'searchstring': $('#search_text').val(),
		}
	
		dataTable = $('#table-grid').DataTable({
			destroy: true,
			"serverSide": true,
			responsive: true,
			"ajax":{
				url:base_url+"app/payer/payer_list_table", // json datasource
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
					$("#table-grid").append('<tbody class="table-grid-error"><tr><th colspan="4">No data found in the server</th></tr></tbody>');
					$("#table-grid_processing").css("display","none");
					$('.btnExcel').hide();
				}
			},
			"columnDefs": [
			  /* { className: "ap-t", "targets": [ 3,4 ] },
			   { className: "dp-t", "targets": [ 5,6,7,8,9,10 ] },*/
			   { orderable: false, "targets": [ 1,2 ] }
			 ]
		});
	}


	
	fillDataTable();


	$('#search_btn').click(function(){
		fillDataTable();
	});


});