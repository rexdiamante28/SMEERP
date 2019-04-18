$(function(){

	var base_url = $("body").data('base_url'); //base_url come from php functions base_url();
	var pageNumberActive = $("#pageActive").data('num');
	var collapseActive = $("#pageActive").data('namecollapse');
	var labelname = $("#pageActive").data('labelname');

	$(".pageNavigation").find("li").each(function(){
		var activePage = $(this).data("num");
		if (pageNumberActive == activePage) {
			$(this).addClass("active");
			$(collapseActive).attr("aria-expanded","true");
			$(collapseActive).closest('li').find('.select-collapse').addClass("show");
			$(collapseActive).closest('li').find('a').each(function(){
				var subnavname = $(this).text();
				if(labelname == subnavname){
					// $(this).css("background","#2b90d9");
					// $(this).css("color","#fff");
					$(this).css("border-left","6px solid #ece");
				}
			});
		}
	});

	$(".select2").select2({});

	$('.datepicker').datepicker({
		todayBtn: "linked",
		format: 'yyyy/mm/dd',
    	startDate: '0',
    	daysOfWeekDisabled: [0,6],    	
	});

	$('.input-daterange').datepicker({
		todayBtn: "linked"
	});



function validate_strong_password(password){
	var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$");

	if (regex.test(password)) {
	    return true;
	}else{
		return false;
	}
}

// ------------------------------------------------------- //
// Sidebar Functionality
// ------------------------------------------------------ //

$(".menu-toggle").click(function(e){
	e.preventDefault();
	$("#sideNav").toggleClass("sidebar-toggle");
	$("#overlay").toggleClass("overlay-toggle");	
});

// $("#overlay").click(function(){
// 	$("#sideNav").toggleClass("sidebar-toggle");
// 	$("#overlay").toggleClass("overlay-toggle");
// });



$("#toggle-btn").click(function(e){
	if ($(this).hasClass('active')) {
		$(".pageNavigation").find('a').css('word-break', 'normal');
	}else{
		
		$(".pageNavigation").find('a').css('word-break', 'break-all');
	}
});

// ------------------------------------------------------- //
});