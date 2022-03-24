(function ($) {

    "use strict";

    /* ---------------------------------------------

    Navigation menu

    --------------------------------------------- */
    $(window).load(function () {

    })


    // accordion script starts
    var rrdevsAccordion = function ($scope, $) {
        var accordionTitle = $scope.find('.rrdevs-accordion-title');

        var accmin = $scope.find('.rrdevs-accordion-single-item');

        accmin.each(function () {
            if ($(this).hasClass('yes')) {
                $(this).addClass('wraper-active');
            }
        });

        accordionTitle.each(function () {
            if ($(this).hasClass('active-default')) {
                $(this).addClass('active');
                $(this).next('.rrdevs-accordion-content').slideDown(300);
            }
        });

        // Remove multiple click event for nested accordion
        accordionTitle.unbind('click');

        //$accordionWrapper.children('.rrdevs-accordion-content').first().show();
        accordionTitle.click(function (e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().slideUp(400);
                $(this).parent().removeClass('wraper-active');

            } else {
                $(this).parent().parent().find('.rrdevs-accordion-title').removeClass('active');

                accmin.removeClass('wraper-active');

                $(this).parent('.yes').removeClass('wraper-active');

                $(this).parent().parent().find('.rrdevs-accordion-content').slideUp(300);

                $(this).parent().addClass('wraper-active');

                $(this).toggleClass('active');
                $(this).next().slideToggle(400);

            }
        });
    }
    // accordion script ends

    var rrdevs_hero_slider = function ($scope, $) {
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

        var modalWrapper = $scope.find('.rrdevs-modal').eq(0),
            modalOverlayWrapper = $scope.find('.rrdevs-modal-overlay'),
            modalItem = $scope.find('.rrdevs-modal-item'),
            modalAction = modalWrapper.find('.rrdevs-modal-image-action'),
            closeButton = modalWrapper.find('.rrdevs-close-btn');

        modalAction.on('click', function (e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('rrdevs-modal');

            var overlay = $(this).data('rrdevs-overlay');
            modalItem.css('display', 'block');
            setTimeout(function () {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function () {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function () {
            var overlay_click_close = $(this).data('rrdevs_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.rrdevs-modal-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    }

    var modal_popup = function ($scope, $) {

        $('.popup-menubar').on('click', function () {
            $('.rrdevs-addons-popup-content').addClass('show')
        })

        $('#offset-menu-close-btn').on('click', function () {
            $('.rrdevs-addons-popup-content').removeClass('show')
        });
    }


    // animated text script starts
    var rrdevs_AnimatedText = function ($scope, $) {
        var animatedWrapper = $scope.find('.rrdevs-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.rrdevs-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');
        if ('function' === typeof Typed) {
            if ('rrdevs-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }
        if ($.isFunction($.fn.Morphext)) {
            if ('rrdevs-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }


    var RRdevs_Addons_Tab = function ($scope, $) {
        $scope.find('ul.tabs li').on('click', function () {
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
                    open: function () {
                    },
                    close: function () {
                        location.reload();

                    }
                }
            });
        }
    };

    // progress bar script starts
    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
        var triggerClass = '.rrdevs-progress-bar-' + id;
        if ('function' === typeof ldBar) {
            if ('line' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('line-bubble' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
                $($('.rrdevs-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ('circle' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    'stroke-dir': 'normal',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('fan' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M10 90A40 40 0 0 1 90 90',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
        }
    }

    var rrdevs_ProgressBar = function ($scope, $) {
        var progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
        if ($.isFunction($.fn.waypoint)) {
            progressBarWrapper.waypoint(function () {
                var element = $(this.element),
                    id = element.data('id'),
                    type = element.data('type'),
                    value = element.data('progress-bar-value'),
                    strokeWidth = element.data('progress-bar-stroke-width'),
                    strokeTrailWidth = element.data('progress-bar-stroke-trail-width'),
                    color = element.data('stroke-color'),
                    trailColor = element.data('stroke-trail-color');
                animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });
        }
    }
    // progress bar script ends

    $(window).on("elementor/frontend/init", function () {

        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs_slider.default", rrdevs_hero_slider);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-modal-popup.default", rrdevs_video_button);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-popup.default", modal_popup);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-animated.default", rrdevs_AnimatedText);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-addons-tab.default", RRdevs_Addons_Tab);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-accordion.default", rrdevsAccordion);
        elementorFrontend.hooks.addAction("frontend/element_ready/rrdevs-progress-bar.default", rrdevs_ProgressBar);


    });

})(jQuery);