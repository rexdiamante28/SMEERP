$(document).ready(function(){

	base_url = $("body").data('base_url');
	ajax_token = $("body").data('token_value');
	ajax_token_name = $("body").data('token_name');

	showCover = function(message){

		$('#current-activity').html(message);
	    $('#transparent-cover').css({'display':'table'});

	}

	hideCover = function(){

		$('#current-activity').html('');
	    $('#transparent-cover').css({'display':'none'});
	    
	}

	sys_log = function(env,data){
		if(env=="development"){
			console.log(data);
		}
	}

	sys_toast = function(message,heading,icon,position,bgcolor,txtcolor)
	{
		$.toast({
		    heading: heading,
		    text: message,
		    icon: icon,
		    loader: false,  
		    stack: false,
		    position: position, 
			allowToastClose: false,
			bgColor: bgcolor,
			textColor: txtcolor  
		});
	}


	tofixed = function(x){
		return numberWithCommas(parseFloat(x).toFixed(2));
	}
	numberWithCommas = function(x){
	  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}


	// toast options
	sys_toast_success = function(message)
	{
		sys_toast(message,'Success','success','top-center','yellowgreen','white');
	}

	sys_toast_error = function(message)
	{
		sys_toast(message,'Error','error','top-center','red','white');
	}

	sys_toast_warning = function(message)
	{
		sys_toast(message,'Warning','warning','top-center','orange','white');
	}

	sys_toast_warning_info = function(message)
	{
		sys_toast(message,'Note','info','top-center','orange','white');
	}

	sys_toast_info = function(message)
	{
		sys_toast(message,'Note','info','top-center','lightblue','white');
	}
	//close the transparent cover once the page was successfully loaded

	hideCover();


	draw_transaction_status = function(status){
		var element = "";
		if(status=='S')
		{
			element = "<label class='badge badge-success'> Paid</label>";

			return element;
		}
		else if(status=='F')
		{
			element = "<label class='badge badge-danger'> Failed</label>";

			return element;
		}
		else if(status=='P')
		{
			element = "<label class='badge badge-info'> Pending</label>";

			return element;
		}
		else 
		{
			element = "<label class='badge badge-danger'> Unpaid</label>";

			return element;
		}
	}

	update_token = function(value)
	{
		$('#template_body').data('token_value',value);
		ajax_token = $("body").data('token_value');
	}

});