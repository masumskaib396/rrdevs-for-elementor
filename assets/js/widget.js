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


    // animated text script starts
    var rrdevs_AnimatedText = function( $scope, $ ) {
        var animatedWrapper = $scope.find( '.rrdevs-typed-strings' ).eq(0),
        animateSelector     = animatedWrapper.find( '.rrdevs-animated-text-animated-heading' ),
        animationType       = animatedWrapper.data( 'heading_animation' ),
        animationStyle      = animatedWrapper.data( 'animation_style' ),
        animationSpeed      = animatedWrapper.data( 'animation_speed' ),
        typeSpeed           = animatedWrapper.data( 'type_speed' ),
        startDelay          = animatedWrapper.data( 'start_delay' ),
        backTypeSpeed       = animatedWrapper.data( 'back_type_speed' ),
        backDelay           = animatedWrapper.data( 'back_delay' ),
        loop                = animatedWrapper.data( 'loop' ) ? true : false,
        showCursor          = animatedWrapper.data( 'show_cursor' ) ? true : false,
        fadeOut             = animatedWrapper.data( 'fade_out' ) ? true : false,
        smartBackspace      = animatedWrapper.data( 'smart_backspace' ) ? true : false,
        id                  = animateSelector.attr('id');
        if ( 'function' === typeof Typed ) {
            if( 'rrdevs-typed-animation' === animationType ){
                var typed = new Typed( '#'+id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor : showCursor,
                    fadeOut : fadeOut,
                    smartBackspace : smartBackspace,
                    startDelay : startDelay,
                    backDelay : backDelay
                });
            }
        }
         if ( $.isFunction( $.fn.Morphext ) ) {
            if( 'rrdevs-morphed-animation' === animationType ){
                $( animateSelector ).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }


    var RRdevs_Addons_Tab = function($scope, $) {
        $scope.find('ul.tabs li').on('click', function() {
            var tab_id = $(this).attr('data-tab');
            $scope.find('ul.tabs li').removeClass('current');
            $scope.find('.rrdevs-addons-tab-content-single').removeClass('current');
            $(this).addClass('current');
            $scope.find("#" + tab_id).addClass('current');
        })
        if ($.fn.magnificPopup) {
            $('.rrdevs-addons-elm-edit').magnificPopup({
                type: 'iframe',
                mainClass: 'mfp-fade rrdevs-addons-elm-edit-popup',
                callbacks: {
                    open: function() {
                    },
                    close: function() {
                            location.reload();

                        }
                }
            });
        }
    };

    $(window).on("elementor/frontend/init", function() {

        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs_slider.default", rrdevs_hero_slider);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-modal-popup.default", rrdevs_video_button);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-popup.default", modal_popup);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-animated.default", rrdevs_AnimatedText);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-addons-tab.default", RRdevs_Addons_Tab);


    });

})(jQuery);