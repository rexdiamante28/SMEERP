$('.sidebar-link').click(function(event){

	if($('.sidebar-child-open').length==0){
		$(event.currentTarget.id).attr("class","sidebar-child sidebar-child-open");
	}
	else if ($('.sidebar-child-open').length>0 && $(event.currentTarget.id).attr("class") == "sidebar-child sidebar-child-open"){
		$(event.currentTarget.id).attr("class","sidebar-child sidebar-child-close");
	}
	else if ($('.sidebar-child-open').length>0 && $(event.currentTarget.id).attr("class") == "sidebar-child sidebar-child-close"){
		$('.sidebar-child-open').attr("class","sidebar-child sidebar-child-close");
		$(event.currentTarget.id).attr("class","sidebar-child sidebar-child-open");
	}
	
	
})