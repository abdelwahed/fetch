$(document).ready(function(){

// STICKY HEADER
        var stickyHeaderTop = $('.navbar').offset().top;

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('.navbar').css({position: 'fixed', top: '0px'})
                } else {
                        $('.navbar').css({position: 'static', top: '0px'});
                }
        });

// NAVIGATION
        // NAV BAR CLICK
        $("#typeNav").click(function() {
            $('html, body').animate({   
            scrollTop: $("#browseType").offset().top
            }, 1000);
        });
        $("#tennisball").click(function() {
            $('html, body').animate({   
            scrollTop: $("#home").offset().top
            }, 1000);
        });
        $('#signUpNav').click(function() {
            $('#signUpModal').modal({
                show: true
            });
        });
        $('#logInNav').click(function() {
            $('#logInModal').modal({
                show: true
            });
        });
        $('signUpFoot').click(function() {
            $('#signUpModal').modal({
                show: true
            });
        });

        //HAMBURGER ICON HOVER
        $("#hamburger_icon").mouseenter(function() {
            $("#hamburger_top").css("top", "2px");
            $("#hamburger_bottom").css("top", "20px");
        });
        $("#hamburger_icon").mouseleave(function() {
            $("#hamburger_top").css("top", "0px");
            $("#hamburger_bottom").css("top", "22px");
        });

        // DOWN ARROW
        $("#downArrow").click(function() {
            console.log('downArrow');
            $('html, body').animate({   
            scrollTop: $("#browseType").offset().top
            }, 1000);
        });
});