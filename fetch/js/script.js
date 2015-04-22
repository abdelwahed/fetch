$(document).ready(function(){

        var stickyHeaderTop = $('.navbar').offset().top;

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('.navbar').css({position: 'fixed', top: '0px'})
                } else {
                        $('.navbar').css({position: 'static', top: '0px'});
                }
        });
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

        //HAMBURGER ICON HOVER
        $("#hamburger_icon").mouseenter(function() {
            $("#hamburger_top").css("top", "2px");
            $("#hamburger_bottom").css("top", "20px");
        });
        $("#hamburger_icon").mouseleave(function() {
            $("#hamburger_top").css("top", "0px");
            $("#hamburger_bottom").css("top", "22px");
        });

        // //HAMBURGER ICON CLICK
        // $("#hamburger_icon").click(function() {
        //     if (activeNav == "menuOpen") {
        //         $("#menu").removeClass("menu-open");
        //         $("#hamburger_top").removeClass("menu-open-hBar");
        //         $("#hamburger_middle").removeClass("menu-open-hBar");
        //         $("#hamburger_bottom").removeClass("menu-open-hBar");
        //         activeNav = "menuClosed";
        //         console.log(activeNav);
        //     } else {
        //         $("#menu").addClass("menu-open");
        //         $("#hamburger_top").addClass("menu-open-hBar");
        //         $("#hamburger_middle").addClass("menu-open-hBar");
        //         $("#hamburger_bottom").addClass("menu-open-hBar");
        //         activeNav = "menuOpen";
        //         console.log(activeNav);
        //     }
        // });

  });