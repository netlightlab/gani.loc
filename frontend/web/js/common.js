$(document).ready(function () {
    if($(window).width() >= 768) {
        var fx_stop = $("#single-fix").outerHeight();
        var fx_height = $("#sidebar").outerHeight();

        $(".tab-link").hover( function () {
            fx_stop = $("#single-fix").outerHeight();
        });

        if ($(document).scrollTop() >= 400) {
            $("#sidebar").css({top: $(document).scrollTop() - 400});
            if ($("#sidebar").offset().top >= fx_stop) {
                $("#sidebar").css({top: fx_stop - fx_height});
            }
        } else {
            $("#sidebar").css({top: 0});
        }

        $(document).scroll(function () {
            var top = $(document).scrollTop();
            if (top >= 400) {
                $("#sidebar").css({top: top - 400});
                if ($("#sidebar").offset().top-100 >= fx_stop) {
                    $("#sidebar").css({top: fx_stop - fx_height});
                }
            } else {
                $("#sidebar").css({top: 0});
            }
        });
    }
});

$(document).hover(function () {
    $("#1").hover(function () {
        $("#ratingBarClick").css({width: $("#1").attr("data-value_rating") + "%"});
    });
    $("#2").hover(function () {
        $("#ratingBarClick").css({width: $("#2").attr("data-value_rating") + "%"});
    });
    $("#3").hover(function () {
        $("#ratingBarClick").css({width: $("#3").attr("data-value_rating") + "%"});
    });
    $("#4").hover(function () {
        $("#ratingBarClick").css({width: $("#4").attr("data-value_rating") + "%"});
    });
    $("#5").hover(function () {
        $("#ratingBarClick").css({width: $("#5").attr("data-value_rating") + "%"});
    });
});

$(".rating_click a").click(function () {

});
    $("#1").click(function (e) {
        e.preventDefault();
        $("#ratingBarClick").css({width: $("#1").attr("data-value_rating") + "%"});
    });
    $("#2").click(function (e) {
        e.preventDefault();
        $("#ratingBarClick").css({width: $("#2").attr("data-value_rating") + "%"});
    });
    $("#3").click(function (e) {
        e.preventDefault();
        $("#ratingBarClick").css({width: $("#3").attr("data-value_rating") + "%"});
    });
    $("#4").click(function (e) {
        e.preventDefault();
        $("#ratingBarClick").css({width: $("#4").attr("data-value_rating") + "%"});
    });
    $("#5").click(function (e) {
        e.preventDefault();
        $("#ratingBarClick").css({width: $("#5").attr("data-value_rating") + "%"});
    });