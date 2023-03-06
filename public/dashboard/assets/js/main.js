(function ($) {
    "use strict";

    // Back to top button
    // $(window).scroll(function () {
    //     if ($(this).scrollTop() > 300) {
    //         $('.back-to-top').fadeIn('slow');
    //     } else {
    //         $('.back-to-top').fadeOut('slow');
    //     }
    // });
    // $('.back-to-top').click(function () {
    //     $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
    //     return false;
    // });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });

    // atendentes carousel
    $(".atendente-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 4,
        dots: true,
        loop: true,
        nav: false,
        responsiveClass: false,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    });

    // whatsapp carousel
    $(".whatsapp-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 4,
        dots: true,
        loop: true,
        nav: false,
        responsiveClass: false,
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: false,
                loop: false
            }
        }
    });


})(jQuery);

