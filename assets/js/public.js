function showCover(message){

	$('#current-activity').html(message);
    $('#transparent-cover').css({'display':'table'});

}

function hideCover(){

	$('#current-activity').html('');
    $('#transparent-cover').css({'display':'none'});
    
}

function showResponse(type,message,container){
	var div = "<div class='alert alert-dismissable alert-"+type+"'>"+
				""+message+
				"<i data-dismiss='alert' class='pull-right glyphicon glyphicon-remove'></i>"+
			  "</div>";
	$(container).html(div);
}


$(document).ready(function(){
	hideCover();
})


loading_content = "";

get_loading_content = function()
{
	loading_content = $('#x_content').html();
}

$('#add_record_trigger').click(function(){
	$("#add_record_form")[0].reset();
	$("#error_message").addClass("hidden");
	$('#form-loading').addClass("hidden");
});



$('#change_password_form').submit(function(event){
	event.preventDefault();

	var form = $(this);

	$.ajax({				
		url: form.attr('action'),
	    type: form.attr('method'),
		data: form.serialize(),
		success : function(response){
			var result = JSON.parse(response);
			if(result.success===true)
			{
				alertify.success(result.message);
				$('#change_password_modal').modal('hide');
			}
			else
			{
				$('#change_password_modal #error_message').removeClass('hidden');
				$('#change_password_modal #error_message').html(result.message);
			}
			
		}
	});

})