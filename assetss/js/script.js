$(".method-container").click(function(){
	var chosen_method = $(this).html();

	$("html").scrollTop(0);
	$("#chosenMethod").html(chosen_method);
	// $(".page-container").addClass("col-lg-8 offset-lg-2");
	$("#payment-option").css("display", "none");
	$("#payment-confirm").css("display", "block");

});

$("#changeMethod").click(function(){
	$("html").scrollTop(0);
	$("#payment-option").css("display", "block");
	$("#payment-confirm").css("display", "none");
});

$(".home.payment-method .method").click(function(){
	$(".home.payment-method .method.clicked").removeClass("clicked");
	$(this).addClass("clicked");
})

// $("#MaTable tbody").on("click", ".pop_admin", function(event){
//     alert($(this).closest('tr').find('td:first').text());
// });