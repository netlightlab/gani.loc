
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