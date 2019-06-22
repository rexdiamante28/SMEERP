let base_url = $("body").data("base_url");

$("#stepwizard").smartWizard({
    theme: "circles",
    transitionEffect: "slide",
    transitionSpeed: "400",
    lang: {
        // Language variables
        next: "Proceed",
        previous: "Go Back"
    },
    toolbarSettings: {
        toolbarExtraButtons: [
            $("<button></button>")
                .text("Finish")
                .addClass("btn btn-info")
                .on("click", function() {
                    $("#submitWizard").click();
                })
        ]
    }
});

$(".sw-btn-group-extra").hide();
$("button.sw-btn-prev").hide();

$("#stepwizard").on("showStep", function(
    e,
    anchorObject,
    stepNumber,
    stepDirection
) {
    if ($("button.sw-btn-next").hasClass("disabled")) {
        $(".sw-btn-group-extra").show();
        $("button.sw-btn-next").hide();
    } else {
        $(".sw-btn-group-extra").hide();
        $("button.sw-btn-next").show();
    }
});

$("#stepwizard").on("showStep", function(
    e,
    anchorObject,
    stepNumber,
    stepDirection
) {
    if ($("button.sw-btn-prev").hasClass("disabled")) {
        $("button.sw-btn-prev").hide();
    } else {
        $("button.sw-btn-prev").show();
    }
});

$(".datepicker").datepicker();

$(document).ready(function() {
    $("#table_id").DataTable();
});

$("div#imageUpload").dropzone({
    url: base_url + "assets/admin/js/dropzone.js"
});
