$(document).ready(function(){
        $(window).scroll(function(){
            if ($(window).scrollTop() > 140 ){
                $(".fixed-bar").css("background", "#2e2e2e");
            } else {
                if ($(window).scrollTop() == 0) {
                    $(".fixed-bar").css("background", "transparent");
                }
            }
        });
    });