$(function() {

    "use strict";

    //=========MENU FIX JS=========
    // if ($('.main_menu').offset() != undefined) {
    //     var navoff = $('.main_menu').offset().top;
    //     $(window).scroll(function() {
    //         var scrolling = $(this).scrollTop();

    //         if (scrolling > navoff) {
    //             $('.main_menu').addClass('menu_fix');
    //         } else {
    //             $('.main_menu').removeClass('menu_fix');
    //         }
    //     });
    // }


    //=========COUNTER JS=========
    $('.counter').countUp();


    //=======SELECT2======
    $(document).ready(function() {
        $('.select_2').select2();
    });


    // ===VENO BOX JS===
    $('.venobox').venobox();


    //*==========ISOTOPE==============
    var $grid = $('.grid').isotope({});

    $('.wsus__location_filter').on('click', 'button', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });

    //active class
    $('.wsus__location_filter button').on("click", function(event) {

        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();

    });


    //=========LISTING SLIDER=========
    $('.listing_slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2000,
        dots: true,
        arrows: false,

        responsive: [{
                breakpoint: 1400,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });



    //*=====TESTIMONIAL SLIDER=====
    $('.testi_slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
        arrows: false,

        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });


    //*==========SCROLL BUTTON==========
    $('.scroll_btn').on('click', function() {
        $('html, body').animate({
            scrollTop: 0,
        }, );
    });

    $(window).on('scroll', function() {
        var scrolling = $(this).scrollTop();

        if (scrolling > 300) {
            $('.scroll_btn').fadeIn();
        } else {
            $('.scroll_btn').fadeOut();
        }
    });


    //=========ABOUT PAGE SLIDER=========
    $('.about_page_slider').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: false,
        arrows: false,


        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    
    // ==========SUMMER NOTE JS==========
    $(document).ready(function() {
        $('.summer_note').summernote();
    });


    //*==========DASHBOARD MENU==========

    $('.menu_icon').on('click', function() {
        $('.dashboard_sidebar').addClass('.menu_show');
    });


    $('.close_icon').on('click', function() {
        $('.dashboard_sidebar').removeClass('.menu_show');
    });

});