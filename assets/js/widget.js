(function($) {

    "use strict";

    /* ---------------------------------------------

    Navigation menu

    --------------------------------------------- */






    $(window).load(function() {

    })


    var rrdevs_hero_slider = function ($scope , $) {

        var wrapper = $scope.find(".rrdevs-hero-slider");




        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
            wrapper.slick({
                infinite: true,
                speed: 900,
                slidesToShow: settings['per_coulmn'],
                slidesToScroll: 1,
                autoplay: settings['autoplay'],
                autoplaySpeed: settings['autoplaytimeout'],
                arrows: settings['nav'],
                draggable: settings['mousedrag'],
                dots: settings['dots'],
                lazyLoad: 'ondemand',
                // adaptiveHeight: true,
                dotsClass: "hero-slider-dot-list",
                swipe: true,
                vertical: settings['show_vertical'],
                appendArrows: '.team-slider-arrow',
                prevArrow: $('.prev'),
                nextArrow: $('.next'),
                responsive: [{
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: settings['per_coulmn'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1000,
                        settings: {
                            slidesToShow: settings['per_coulmn_tablet'],
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: settings['per_coulmn_mobile'],
                            slidesToScroll: 1,
                            vertical: false,
                        },
                    },
                ],
            });

    }




    $(window).on("elementor/frontend/init", function() {

        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs_slider.default", rrdevs_hero_slider);


    });

})(jQuery);