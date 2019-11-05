//Global var
var IMAX = {};

(function ($) {

    // USE STRICT
    "use strict";

    //----------------------------------------------------/
    // Predefined Variables
    //----------------------------------------------------/
    var $window = $(window),
        $document = $(document);

    /*
    #################################
        -- ANIMATION --
    #################################
    */
    IMAX.inviewAnimation = function () {
        // animate css + jquery inview configuration
        var inviewAnimate = $(".animate");
        if(inviewAnimate) {
            inviewAnimate.each(function () {
                $(this).bind('inview', function (event, visible) {
                    var $this = $(this),
                        $animation = ($this.data("animation") !== undefined) ? $this.data("animation") : "slideUp";
                    var $delay = ($this.data("delay") !== undefined) ? $this.data("delay") : 500;
                    if (visible == true) {
                        setTimeout(function () {
                            $this.addClass($animation);
                        }, $delay);
                    }
                    /*else{
                        setTimeout(function() { $this.removeClass($animation); },$delay);
                    }*/
                });
            });
        }
    };

    /*
    #################################
        -- PROGRESS BAR --
    #################################
    */
    IMAX.runAnimateProgressBar = function () {
        var animateProgressBar = $(".animate-bar");
        if(animateProgressBar){
            if (animateProgressBar.length) {
                animateProgressBar.appear();
                $(document.body).on('appear', '.animate-bar', function (e, $affected) {
                    e.preventDefault();
                    $(this).progressbar({
                        display_text: 'center',
                        use_percentage: true
                    });
                });
            }
        }
    };

    /*
    #################################
        -- ANIMATE ELEMENTS --
    #################################
    */
    //Set of functions to manage the animations of the elements
    IMAX.animateElements = function () {
        if ($('.animate-if-visible').length) {
            $('.animate-if-visible').appear();
            $(document.body).on('appear', '.animate-if-visible', function (e, $affected) {
                // this code is executed for each appeared element
                e.preventDefault();
                var element = $(this);
                var animationOptions = element.data('animation-options');
                runAnimationTransition(element, animationOptions);
            });
        }
        if ($('.animate-group').length) {
            $('.animate-group').appear();
            $(document.body).on('appear', '.animate-group', function (e, $affected) {
                e.preventDefault();
                var element = $(this);
                var animationInterval = 200;
                if (typeof $(this).data('animation-interval') !== 'undefined') {
                    animationInterval = parseInt($(this).data('animation-interval'));
                }
                var totalAnimations = 0;
                var elements = [];

                element.find('.animate').each(function (n) {
                    elements[n] = $(this);
                    totalAnimations++;
                });
                runAnimationGroup(elements, totalAnimations, 0, animationInterval);

            });
        }
        // Force appear. This is suitable in cases when page is in initial state (not scrolled and not resized)
        $.force_appear();
    };

    /*
    #################################
        -- COUNTER ANIMATED NUMBER --
    #################################
    */
    IMAX.counterAnimatedNumber = function () {
        var counterNumber = $('.counternumber');
        if(counterNumber){
            if (counterNumber.length) {
                counterNumber.appear();
                $(document.body).on('appear', counterNumber, function (e, $affected) {
                    e.preventDefault();
                    (function ($) {
                        $.fn.countTo = function (options) {
                            options = options || {};

                            return $(this).each(function () {
                                // set options for current element
                                e.preventDefault();
                                var settings = $.extend({}, $.fn.countTo.defaults, {
                                    from: $(this).data('from'),
                                    to: $(this).data('to'),
                                    speed: $(this).data('speed'),
                                    refreshInterval: $(this).data('refresh-interval'),
                                    decimals: $(this).data('decimals')
                                }, options);

                                // how many times to update the value, and how much to increment the value on each update
                                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                                    increment = (settings.to - settings.from) / loops;

                                // references & variables that will change with each update
                                var self = this,
                                    $self = $(this),
                                    loopCount = 0,
                                    value = settings.from,
                                    data = $self.data('countTo') || {};

                                $self.data('countTo', data);

                                // if an existing interval can be found, clear it first
                                if (data.interval) {
                                    clearInterval(data.interval);
                                }
                                data.interval = setInterval(updateTimer, settings.refreshInterval);

                                // initialize the element with the starting value
                                render(value);

                                function updateTimer() {
                                    e.preventDefault();
                                    value += increment;
                                    loopCount++;

                                    render(value);

                                    if (typeof (settings.onUpdate) == 'function') {
                                        settings.onUpdate.call(self, value);
                                    }

                                    if (loopCount >= loops) {
                                        // remove the interval
                                        $self.removeData('countTo');
                                        clearInterval(data.interval);
                                        value = settings.to;

                                        if (typeof (settings.onComplete) == 'function') {
                                            settings.onComplete.call(self, value);
                                        }
                                    }
                                }

                                function render(value) {
                                    e.preventDefault();
                                    var formattedValue = settings.formatter.call(self, value, settings);
                                    $self.html(formattedValue);
                                }
                            });
                        };

                        $.fn.countTo.defaults = {
                            from: 0,               // the number the element should start at
                            to: 0,                 // the number the element should end at
                            speed: 1000,           // how long it should take to count between the target numbers
                            refreshInterval: 100,  // how often the element should be updated
                            decimals: 0,           // the number of decimal places to show
                            formatter: formatter,  // handler for formatting the value before rendering
                            onUpdate: null,        // callback method for every time the element is updated
                            onComplete: null       // callback method for when the element finishes updating
                        };

                        function formatter(value, settings) {
                            return value.toFixed(settings.decimals);
                        }
                    }(jQuery));

                    jQuery(function ($) {
                        // start all the timers
                        e.preventDefault();
                        counterNumber.each(count);

                        function count(options) {
                            e.preventDefault();
                            var $this = $(this);
                            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                            $this.countTo(options);
                        }
                    });
                });
            }
        }
    };

    /*
    #################################
        -- TWITTER BOOTSTRAP TOGGLE --
    #################################
    */
    IMAX.bootstrapToggle = function () {
        var iTooltip = $('[data-toggle="tooltip"]');
        if(iTooltip){
            iTooltip.tooltip();
        }
    };

    /*
    #################################
        -- TWITTER BOOTSTRAP TOGGLE --
    #################################
    */
    IMAX.bootstrapTogglePopover = function () {
        var iPopover = $('[data-toggle="popover"]');
        if(iPopover){
            iPopover.popover()
        }
    };

    /*
    #################################
        -- PRETTYPHOTO --
    #################################
    */
    IMAX.prettyPhoto = function () {
        var photoPopup = $("a[data-gal^='prettyPhoto']");
        if(photoPopup){
            photoPopup.prettyPhoto({
                animation_speed: 'fast',
                /* fast/slow/normal */
                slideshow: 5000,
                /* false OR interval time in ms */
                autoplay_slideshow: false,
                /* true/false */
                opacity: 0.80,
                /* Value between 0 and 1 */
                show_title: true,
                /* true/false */
                allow_resize: true,
                /* Resize the photos bigger than viewport. true/false */
                default_width: 500,
                default_height: 344,
                counter_separator_label: '/',
                /* The separator for the gallery counter 1 "of" 2 */
                theme: 'pp_default',
                /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                horizontal_padding: 20,
                /* The padding on each side of the picture */
                hideflash: false,
                /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
                wmode: 'opaque',
                /* Set the flash wmode attribute */
                autoplay: true,
                /* Automatically start videos: True/False */
                modal: false,
                /* If set to true, only the close button will close the window */
                deeplinking: true,
                /* Allow prettyPhoto to update the url to enable deeplinking. */
                overlay_gallery: true,
                /* If set to true, a gallery will overlay the fullscreen image on mouse over */
                keyboard_shortcuts: true,
                /* Set to false if you open forms inside prettyPhoto */
                changepicturecallback: function () { },
                /* Called everytime an item is shown/changed */
                callback: function () { },
                /* Called when prettyPhoto is closed */
                ie6_fallback: true,
            });
        }
    };

    /*
    #################################
        -- ONE PAGE NAV --
    #################################
    */
    IMAX.singlePageNav = function () {
        var singleNavbar = $(".navbar");
        if (singleNavbar.hasClass("single-page-nav")) {
            $('.single-page-nav').onePageNav({
                filter: ':not(.external)',
            });
        }
    };

    /*
    #################################
        -- BACK TO TOP --
    #################################
    */
    IMAX.backToTop = function () {
        var backToTopLink = $('#back-to-top');
        if(backToTopLink){
            $(window).scroll(function (e) {
                e.preventDefault();
                if ($(this).scrollTop() > 200) {
                    backToTopLink.fadeIn();
                } else {
                    backToTopLink.fadeOut();
                }
            });
            // scroll body to 0px on click
            backToTopLink.on("click", function (e) {
                e.preventDefault();
                backToTopLink.tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        }
    };

    /*
    #################################
        -- STICKY HEADER --
    #################################
    */
    IMAX.stickyHeader = function () {
        var stickyHeader = $('.main-header.sticky-header');
        if(stickyHeader){
            var stickyRibbonTop = stickyHeader.offset().top;     
            $(window).scroll(function(){
                if( $(window).scrollTop() > stickyRibbonTop ) {
                    stickyHeader.addClass("smaller");
                } else {
                    stickyHeader.removeClass("smaller");
                }
            });
        }
    };

    /*
    #################################
        -- MASONRY STYLE --
    #################################
    */
    IMAX.masnoryStyleGallery = function () {
        var masnory;
        var masnoryGallery = $(".masnory-gallery");
        if(masnoryGallery){
            return masnory = masnoryGallery, masnory.isotope({
                layoutMode: "sloppyMasonry",
                itemSelector: ".masnory-gallery-item"
            }), $("#masnory-gallery-filter a").click(function (e) {
                e.preventDefault();
                var filter;
                return $(this).closest("ul").find("li").removeClass("active"), $(this).parent().addClass("active"), filter = $(this).attr("data-filter"), masnory.isotope({
                    filter: filter
                })
            })
        }
    };

    /*
    #################################
        -- MASONRY STYLE --
    #################################
    */
    IMAX.masnoryStyle = function () {
        var masnory;
        var masnoryContainer = $(".masnory-container");
        if(masnoryContainer){
            return masnory = masnoryContainer, masnory.isotope({
                layoutMode: "sloppyMasonry",
                itemSelector: ".masnory-item"
            }), $("#masnory-filter a").on("click", function (e) {
                e.preventDefault();
                var filter;
                return $(this).closest("ul").find("li").removeClass("active"), $(this).parent().addClass("active"), filter = $(this).attr("data-filter"), masnory.isotope({
                    filter: filter
                })
            })
        }
    };

    /*
    #################################
        -- EQUAL COLUMNS --
    #################################
    */
    IMAX.EqualHeightColumns = function () {
        $('.equal-height-row').each(function () {
            var heights = [];
            $('.equal-height-column', this).each(function () {
                $(this).removeAttr('style');
                heights.push($(this).height()); // Write column's heights to the array
            });
            $('.equal-height-column', this).height(Math.max.apply(Math, heights)); // Find and set max
        });
    };

    /*
    #################################
        -- SCREEN RESIZING SETTINGS --
    #################################
    */
    IMAX.headerLogoTopPosition = function () {
        var logoPositionTopSetting = $(".logo-position-top-setting");
        var whiteBgSetting = $(".white-bg-setting");
        var lightBgSetting = $(".light-bg-setting");
        var darkBgSetting = $(".dark-bg-setting");
        var baseBgSetting = $(".base-bg-setting");
        var transparentHeaderNavbar = $(".transparent-header .navbar");
        var semiTransparentHeaderNavbar = $(".semi-transparent-header .navbar");
        var dropdownMenuAnimateSetting = $(".dropdown ul.dropdown-menu.animate-setting");
        var leftHeader = $("body.left-header");
        var rightHeader = $("body.right-header");
        if ($(window).width() < 1000) {
            // HEADER LOGO TOP POSITION SETTINGS
            if(logoPositionTopSetting){ logoPositionTopSetting.removeClass("logo-position-top"); }
            if(whiteBgSetting){ whiteBgSetting.removeClass("white-bg"); }
            if(lightBgSetting){ lightBgSetting.removeClass("light-bg"); }
            if(darkBgSetting){ darkBgSetting.removeClass("dark-bg"); }
            if(baseBgSetting){ baseBgSetting.removeClass("base-bg"); }
            // HEADER TRANSPARENT SETTINGS
            if(transparentHeaderNavbar){ transparentHeaderNavbar.removeClass("transparent"); }
            if(semiTransparentHeaderNavbar){ semiTransparentHeaderNavbar.removeClass("semi-transparent"); }
            // REMOVE SUBMENU HOVER ANIMATION
            if(dropdownMenuAnimateSetting){ dropdownMenuAnimateSetting.removeClass("animate"); }
            // REMOVE LEFT HEADER SETTING
            if(leftHeader){ leftHeader.removeClass("left-header-setting"); }
            // REMOVE RIGHT HEADER SETTING
            if(rightHeader){ rightHeader.removeClass("right-header-setting"); }
        } else {
            // HEADER LOGO TOP POSITION SETTINGS
            if(logoPositionTopSetting){ logoPositionTopSetting.addClass("logo-position-top"); }
            if(whiteBgSetting){ whiteBgSetting.addClass("white-bg"); }
            if(lightBgSetting){ lightBgSetting.addClass("light-bg"); }
            if(darkBgSetting){ darkBgSetting.addClass("dark-bg"); }
            if(baseBgSetting){ baseBgSetting.addClass("base-bg"); }
            // HEADER TRANSPARENT SETTINGS
            if(transparentHeaderNavbar){ transparentHeaderNavbar.addClass("transparent"); }
            if(semiTransparentHeaderNavbar){ semiTransparentHeaderNavbar.addClass("semi-transparent"); }
            // REMOVE SUBMENU HOVER ANIMATION
            if(dropdownMenuAnimateSetting){ dropdownMenuAnimateSetting.addClass("animate"); }
            // REMOVE LEFT HEADER SETTING
            if(leftHeader){ leftHeader.addClass("left-header-setting"); }
            // REMOVE RIGHT HEADER SETTING
            if(rightHeader){ rightHeader.addClass("right-header-setting"); }
        }
    };

    /*
    #################################
        -- FULL SCREEN --
    #################################
    */
    IMAX.fullScreen = function () {
        var winWidth = $(window).width();
        var winHeight = $(window).height();
        var contentHeight = $(".fullscreen-setting").height();
        //$(".fullscreenxx").css({'width': winWidth,'height': winHeight,});
        if (contentHeight > winHeight) {
            $(".fullscreen").css({ 'width': winWidth, 'height': contentHeight, });
        } else {
            $(".fullscreen").css({ 'width': winWidth, 'height': winHeight, });
        }
        //$(".innerheight").css({'height': contentHeight,});
    };

    /*
    #################################
        -- CHANGE BOX --
    #################################
    */
    IMAX.changeBox = function () {
        var change = $(".change");
        var changeBox = $(".change-box");
        change.on("click", function () {
            if (changeBox.hasClass('box-show')) {
                changeBox.addClass('box-hide').removeClass('box-show');
            }
            else {
                changeBox.addClass('box-show').removeClass('box-hide');
            }
        });
    };

    /*
    #################################
        -- ANIMATED ROTATE TEXT --
    #################################
    */
    IMAX.animatedRotateText = function () {
        var textBounce = $(".text-bounce");
        if(textBounce){
            textBounce.Morphext({
                animation: "bounce",
            });
        }
        var textFlash = $(".text-flash");
        if(textFlash){
            textFlash.Morphext({
                animation: "flash",
            });
        }
        var textPulse = $(".text-pulse");
        if(textPulse){
            textPulse.Morphext({
                animation: "pulse",
            });
        }
        var textRubberBand = $(".text-rubberBand");
        if(textRubberBand){
            textRubberBand.Morphext({
                animation: "rubberBand",
            });
        }
        var textShake = $(".text-shake");
        if(textShake){
            textShake.Morphext({
                animation: "shake",
            });
        }
        var textSwing = $(".text-swing");
        if(textSwing){
            textSwing.Morphext({
                animation: "swing",
            });
        }    
        var textTada = $(".text-tada");
        if(textTada){
            textTada.Morphext({
                animation: "tada",
            });
        }
        var textWobble = $(".text-wobble");
        if(textWobble){
            textWobble.Morphext({
                animation: "wobble",
            });
        }
        var textBounceIn = $(".text-bounceIn");
        if(textBounceIn){
            textBounceIn.Morphext({
                animation: "bounceIn",
            });
        }
        var textBounceInDown = $(".text-bounceInDown");
        if(textBounceInDown){
            textBounceInDown.Morphext({
                animation: "bounceInDown",
            });
        }
        var textBounceInLeft = $(".text-bounceInLeft");
        if(textBounceInLeft){
            textBounceInLeft.Morphext({
                animation: "bounceInLeft",
            });
        }
        var textBounceInRight = $(".text-bounceInRight");
        if(textBounceInRight){
            textBounceInRight.Morphext({
                animation: "bounceInRight",
            });
        }
        var textBounceInUp = $(".text-bounceInUp");
        if(textBounceInUp){
            textBounceInUp.Morphext({
                animation: "bounceInUp",
            });
        }
        var textFadeIn = $(".text-fadeIn");
        if(textFadeIn){
            textFadeIn.Morphext({
                animation: "fadeIn",
            });
        }
        var textFadeInDown = $(".text-fadeInDown");
        if(textFadeInDown){
            textFadeInDown.Morphext({
                animation: "fadeInDown",
            });
        }
        var textFadeInDownBig = $(".text-fadeInDownBig");
        if(textFadeInDownBig){
            textFadeInDownBig.Morphext({
                animation: "fadeInDownBig",
            });
        }
        var textFadeInLeft = $(".text-fadeInLeft");
        if(textFadeInLeft){
            textFadeInLeft.Morphext({
                animation: "fadeInLeft",
            });
        }
        var textFadeInLeftBig = $(".text-fadeInLeftBig");
        if(textFadeInLeftBig){
            textFadeInLeftBig.Morphext({
                animation: "fadeInLeftBig",
            });
        }
        var textFadeInRight = $(".text-fadeInRight");
        if(textFadeInRight){
            textFadeInRight.Morphext({
                animation: "fadeInRight",
            });
        }
        var textFadeInRightBig = $(".text-fadeInRightBig");
        if(textFadeInRightBig){
            textFadeInRightBig.Morphext({
                animation: "fadeInRightBig",
            });
        }
        var textFadeInUp = $(".text-fadeInUp");
        if(textFadeInUp){
            textFadeInUp.Morphext({
                animation: "fadeInUp",
            });
        }
        var textFadeInUpBig = $(".text-fadeInUpBig");
        if(textFadeInUpBig){
            textFadeInUpBig.Morphext({
                animation: "fadeInUpBig",
            });
        }
        var textFlip = $(".text-flip");
        if(textFlip){
            textFlip.Morphext({
                animation: "flip",
            });
        }    
        var textFlipInX = $(".text-flipInX");
        if(textFlipInX){
            textFlipInX.Morphext({
                animation: "flipInX",
            });
        }
        var textFlipInY = $(".text-flipInY");
        if(textFlipInY){
            textFlipInY.Morphext({
                animation: "flipInY",
            });
        }
        var textRotateIn = $(".text-rotateIn");
        if(textRotateIn){
            textRotateIn.Morphext({
                animation: "rotateIn",
            });
        }
        var textRotateInDownLeft = $(".text-rotateInDownLeft");
        if(textRotateInDownLeft){
            textRotateInDownLeft.Morphext({
                animation: "rotateInDownLeft",
            });
        }
        var textRotateInDownRight = $(".text-rotateInDownRight");
        if(textRotateInDownRight){
            textRotateInDownRight.Morphext({
                animation: "rotateInDownRight",
            });
        }
        var textRotateInUpLeft = $(".text-rotateInUpLeft");
        if(textRotateInUpLeft){
            textRotateInUpLeft.Morphext({
                animation: "rotateInUpLeft",
            });
        }
        var textRotateInUpRight = $(".text-rotateInUpRight");
        if(textRotateInUpRight){
            textRotateInUpRight.Morphext({
                animation: "rotateInUpRight",
            });
        }
        var textZoomIn = $(".text-zoomIn");
        if(textZoomIn){
            textZoomIn.Morphext({
                animation: "zoomIn",
            }); 
        }
        var textZoomInDown = $(".text-zoomInDown");
        if(textZoomInDown){
            textZoomInDown.Morphext({
                animation: "zoomInDown",
            });
        }
        var textZoomInLeft = $(".text-zoomInLeft");
        if(textZoomInLeft){
            textZoomInLeft.Morphext({
                animation: "zoomInLeft",
            });
        }
        var textZoomInRight = $(".text-zoomInRight");
        if(textZoomInRight){
            textZoomInRight.Morphext({
                animation: "zoomInRight",
            });
        }
        var textZoomInUp = $(".text-zoomInUp");
        if(textZoomInUp){
            textZoomInUp.Morphext({
                animation: "zoomInUp",
            });
        }
        var textLightSpeedIn = $(".text-lightSpeedIn");
        if(textLightSpeedIn){
            textLightSpeedIn.Morphext({
                animation: "lightSpeedIn",
            });
        }
        var textRollIn = $(".text-rollIn");
        if(textRollIn){
            textRollIn.Morphext({
                animation: "rollIn",
            });
        }
    };

    /*
    #################################
        -- LEFT HEADER SETTINGS --
    #################################
    */
    IMAX.leftHeaderSetting = function () {
        // LEFT HEADER SETTING
        var leftHeaderNavDiv = $(".left-header .navbar div");
        var leftHeaderNavHeader = $(".left-header .navbar-header");
        var leftHeaderMainHeader = $(".left-header .main-header");
        leftHeaderNavDiv.removeClass("container");
        leftHeaderNavHeader.removeClass("border");
        leftHeaderMainHeader.removeClass("sticky-header");
        // RIGHT HEADER SETTING
        var rightHeaderNavDiv = $(".right-header .navbar div");
        var rightHeaderNavHeader = $(".right-header .navbar-header");
        var rightHeaderMainHeader = $(".right-header .main-header");
        rightHeaderNavDiv.removeClass("container");
        rightHeaderNavHeader.removeClass("border");
        rightHeaderMainHeader.removeClass("sticky-header");
    };

    /*
    #################################
        -- MENU ICON INSIDE SETTING --
    #################################
    */
    IMAX.menuIconInside = function () {
        var menustate = false;
        var iMenuIconInside = $(".menu-icon-inside");
        iMenuIconInside.on('click', function () {
            if (menustate == false) {
                jQuery(".navbar-nav").addClass("showmenu");
                jQuery(".menu-icon.menu-icon-standard").addClass("opened");
                menustate = true;
            } else {
                jQuery(".navbar-nav").removeClass("showmenu");
                jQuery(".menu-icon.menu-icon-standard").removeClass("opened");
                menustate = false;
            }
        });
    };

    /*
    #################################
        -- SMOOTH SCROLL --
    #################################
    */
    IMAX.smoothScroll = function () {
        //$(".scroll").easeScroll();
    };

    /*
    #################################
        -- MODEL ON LOAD PAGE --
    #################################
    */
    IMAX.modalOnload = function () {
        var iModal = $(".modal-onload");
        if(iModal){
            iModal.modal('show');
        }
    };

    // Window Load Functions
    $window.load(function () {
        IMAX.inviewAnimation(),
        IMAX.runAnimateProgressBar(),
        IMAX.animateElements(),
        IMAX.counterAnimatedNumber(),
        IMAX.bootstrapToggle(),
        IMAX.bootstrapTogglePopover(),
        IMAX.prettyPhoto(),
        IMAX.singlePageNav(),
        IMAX.backToTop(),
        IMAX.stickyHeader(),
        IMAX.masnoryStyleGallery(),
        IMAX.masnoryStyle(),
        IMAX.leftHeaderSetting(),
        IMAX.menuIconInside(),
        IMAX.smoothScroll(),
        IMAX.EqualHeightColumns(),
        IMAX.modalOnload(),
        IMAX.headerLogoTopPosition()
    });

    //Document Ready Functions
    $document.ready(function(){
        IMAX.headerLogoTopPosition(),
        IMAX.fullScreen(),
        IMAX.changeBox(),
        IMAX.EqualHeightColumns(),
        IMAX.animatedRotateText(),
        IMAX.modalOnload()
    });

    //Document Resize Functions
    $window.resize(function () {
        IMAX.headerLogoTopPosition(),
        IMAX.fullScreen(),
        IMAX.EqualHeightColumns()
    });

})(jQuery);