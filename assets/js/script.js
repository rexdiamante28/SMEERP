$(".sidebar-toggler").click(function(){
    $("body").toggleClass("sidebar-toggle");
});

var pageNumberActive = $("#pageActive").data('num');
var labelname = $("#pageActive").data('labelname');

$(".list-group").find("a").each(function(){
	var activePage = $(this).data("num");
	if (pageNumberActive == activePage) {
		$(this).addClass("active");
	}

	if (pageNumberActive != activePage) {
		$(this).removeClass("active");
	}
});

var form = $("#example-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
});

$(document).ready(function() {
    $('#example').DataTable({
        searching: false
    });
} );

$(document).ready(function() {
    $('#example2').DataTable({
        searching: false
    });
} );

