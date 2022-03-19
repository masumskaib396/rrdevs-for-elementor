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

    /*---------------------------------------------------
    VIDEO BUTTON
    ----------------------------------------------------*/
    var rrdevs_video_button = function ($scope, $) {

        var modalWrapper    = $scope.find( '.rrdevs-modal' ).eq(0),
        modalOverlayWrapper = $scope.find( '.rrdevs-modal-overlay' ),
        modalItem           = $scope.find( '.rrdevs-modal-item' ),
        modalAction         = modalWrapper.find( '.rrdevs-modal-image-action' ),
        closeButton         = modalWrapper.find( '.rrdevs-close-btn' );

        modalAction.on( 'click', function(e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal         = $(this).data( 'rrdevs-modal' );

            var overlay = $(this).data( 'rrdevs-overlay' );
            modalItem.css( 'display', 'block' );
            setTimeout( function() {
                $(modal).addClass( 'active' );
            }, 100);
            if ( 'yes' === overlay ) {
                modalOverlay.addClass( 'active' );
            }

        } );

        closeButton.click( function() {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem    = $(this).parents().eq(2);
            modalOverlay.removeClass( 'active' );
            modalItem.removeClass( 'active' );

            var modal_iframe = modalWrapper.find( 'iframe' ),
            $modal_video_tag  = modalWrapper.find( 'video' );

            if ( modal_iframe.length ) {
                var modal_src = modal_iframe.attr( 'src' ).replace( '&autoplay=1', '' );
                modal_iframe.attr( 'src', '' );
                modal_iframe.attr( 'src', modal_src );
            }
            if ( $modal_video_tag.length ) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        } );

        modalOverlayWrapper.click( function() {
            var overlay_click_close = $(this).data( 'rrdevs_overlay_click_close' );
            if( 'yes' === overlay_click_close ){
                $(this).removeClass( 'active' );
                $( '.rrdevs-modal-item' ).removeClass( 'active' );

                var modal_iframe = modalWrapper.find( 'iframe' ),
                $modal_video_tag = modalWrapper.find( 'video' );

                if ( modal_iframe.length ) {
                    var modal_src = modal_iframe.attr( 'src' ).replace( '&autoplay=1', '' );
                    modal_iframe.attr( 'src', '' );
                    modal_iframe.attr( 'src', modal_src );
                }
                if ( $modal_video_tag.length ) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        } );
    }

    var modal_popup = function ($scope, $) {

        $('.popup-menubar').on('click', function() {
           $('.rrdevs-addons-popup-content').addClass('show')
       })

       $('#offset-menu-close-btn').on('click', function() {            
             $('.rrdevs-addons-popup-content').removeClass('show')
        });
    }

    $(window).on("elementor/frontend/init", function() {

        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs_slider.default", rrdevs_hero_slider);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-modal-popup.default", rrdevs_video_button);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-popup.default", modal_popup);


    });

})(jQuery);