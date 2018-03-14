if ($(window).scrollTop() > 40) {
	$("header").css("background", "#2e2e2e");
    $("header").addClass("sticky");
}
$(window).scroll(function(){
    if ($(window).scrollTop() > 40 ){
        $("header").css("background", "#2e2e2e");
        $("header").addClass("sticky");
    } else {
        if ($(window).scrollTop() == 0) {
            $("header").css("background", "linear-gradient(180deg, rgba(0, 105, 138, .5), transparent)");
            $("header").removeClass("sticky")
        }
    }
});