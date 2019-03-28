'use strict';

(function ($) {
    "use strict";

    // Internet Explorer 10 in Windows Phone 8 viewport bug

    if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement('style');
        msViewportStyle.appendChild(document.createTextNode('@-ms-viewport{width:auto!important}'));
        document.head.appendChild(msViewportStyle);
    }

    // Check if element is in viewport
    $.fn.isInViewport = function () {
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();

        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };

    // Set max-height on the elements in a row
    function equalHeight(container) {

        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = [],
            $el,
            topPosition = 0;

        $(container).each(function (i) {

            $el = $(this);
            $el.height('auto');
            topPosition = $el.offset().top;

            if (currentRowStart != topPosition) {
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
                rowDivs.length = 0; // empty the array
                currentRowStart = topPosition;
                currentTallest = $el.height();
                rowDivs.push($el);
            } else {
                rowDivs.push($el);
                currentTallest = currentTallest < $el.height() ? $el.height() : currentTallest;
            }
            for (var currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
        });
    }

    // From https://davidwalsh.name/javascript-debounce-function.
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            var later = function later() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    function checkVisibility(el) {
        var dTop = $(window).scrollTop(),
            dBot = dTop + $(window).height(),
            elTop = $(el).offset().top,
            elBot = elTop + $(el).height();
        return elTop <= dBot && elTop >= dTop;
    }

    // left: 37, up: 38, right: 39, down: 40,
    // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
    var keys = { 37: 1, 38: 1, 39: 1, 40: 1 };

    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault) e.preventDefault();
        e.returnValue = false;
    }

    function preventDefaultForScrollKeys(e) {
        if (keys[e.keyCode]) {
            preventDefault(e);
            return false;
        }
    }

    function disableScroll() {
        if (window.addEventListener) // older FF
            window.addEventListener('DOMMouseScroll', preventDefault, false);
        window.onwheel = preventDefault; // modern standard
        window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
        window.ontouchmove = preventDefault; // mobile
        document.onkeydown = preventDefaultForScrollKeys;
    }

    function enableScroll() {
        if (window.removeEventListener) window.removeEventListener('DOMMouseScroll', preventDefault, false);
        window.onmousewheel = document.onmousewheel = null;
        window.onwheel = null;
        window.ontouchmove = null;
        document.onkeydown = null;
    }

    $(document).ready(function () {



        function sliderSet () {
            return {
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                prevArrow: ".home-slider-left2",
                nextArrow: ".home-slider-right2",
                dots: false,
            }
        };

        $('.slider-for-plan').slick(sliderSet ());

        
        $('.flat-plan-buttons').on('click', '.flat-plan-btn:not(.act-fb)', function() {
            $(this)
                .addClass('act-fb').siblings().removeClass('act-fb')
                .closest('.flat-plan-box').find('.flat-plan-img').removeClass('fpi-act').eq($(this).index()).addClass('fpi-act');
                $('.slider-for-plan').slick('setPosition');
        });
        

        $(".one-flat").on('click', function() {

            var title = $(this).attr('data-title');
            var room = $(this).children('.j-room').text();
            var meter = $(this).children('.j-meter').text();
            var floor = $(this).children('.j-floor').text();
            var price = $(this).children('.j-price').text();
            var price_m = $(this).children('.j-price_m').text();
            var plan = $(this).attr('data-plan');
            var plan_f = $(this).attr('data-planf');
  
          $.fancybox.open({
            src  : '#flat',
            type : 'inline',
            opts : {
              beforeShow : function( instance, current ) {
                $('#flat').find('.m-room').text(room);
                $('#flat').find('.m-meter').text(meter);
                $('#flat').find('.b-name').text(title);
                $('#flat').find('.m-floor').text(floor);
                $('#flat').find('.mm-room').text(room);
                $('#flat').find('.mm-meter').text(meter);
                $('#flat').find('.m-pricem').text(price_m);
                $('#flat').find('.m-price').text(price);
                $('#flat').find('.m-plan').attr('src', plan);
                $('#flat').find('.m-plan').closest('a').attr('href', plan);
                // $('#flat').find('.m-planf').attr('src', plan_f);
                var ihf = $('#flat .flat-modal-right h2').text();
                var ihcom = $('.company-inp').text();
                $('.input-hidden-c').val(ihcom);
                $('.input-hidden-f').val(ihf);

                

              },

              afterShow : function( instance, current ) {
        
                $('.slider-for-plan').slick('unslick');
                $('.slider-for-plan').slick(sliderSet ());

              },

            }
          });
          
        });

        

        $(".one-flat2").on('click', function() {

            var ihf = $(this).closest('.best-deals-item').find('.flat-inp').text();
          $.fancybox.open({
            src  : '#flat2',
            type : 'inline',
            opts : {
              beforeShow : function( instance, current ) {
                
                var ihcom = $('.company-inp').text();
                $('.input-hidden-c').val(ihcom);
                $('.input-hidden-f').val(ihf);
              }
            }
          });
          
        });

        var ihcom = $('.company-inp').text();
        var ihho = $('.house-inp').text();
        var ihf = $('.flat-modal-right h2').text();

        $('.input-hidden-com').val(ihcom);
        $('.input-hidden-ho').val(ihho);

        $('.input-hidden-c').val(ihcom);
        $('.input-hidden-f').val(ihf);

        $('.radio input').on('change', function(){

            var irooms = parseInt($('.apartment-choice-form').find( "input:radio[name=count]:checked" ).val());

                var minSquare = 1;
                var maxSquare = 9999;
                var minPrice = 1;
                var maxPrice = 9999999;

                if($('.sq-min').val()){
                     minSquare = $('.sq-min').val();
                }

                if($('.sq-max').val()){
                     maxSquare = $('.sq-max').val();  
                }

                if($('.p-min').val()){
                     minPrice = $('.p-min').val(); 
                }

                if($('.p-max').val()){
                     maxPrice = $('.p-max').val();
                }

            var flats = $('.one-flat');

                flats.addClass('flat-invisible');

                if(irooms === 0){

                    // console.log(irooms);

                    var filtered = $( flats )
                  .filter(function( index ) {

                    return true && 
                        (parseInt($( ".j-meter", this ).text()) >= parseInt(minSquare)) && (parseInt($( ".j-meter", this ).text()) <= parseInt(maxSquare)) &&
                        (parseInt($( ".j-price", this ).text()) >= parseInt(minPrice)) && (parseInt($( ".j-price", this ).text()) <= parseInt(maxPrice));
                  })
                    .removeClass('flat-invisible');

                } else if(irooms !== 0){

                    console.log(irooms);

                    var filtered = $( flats )
                  .filter(function( index ) {

                    return (parseInt($( ".j-room", this ).text()) === irooms) && 
                        (parseInt($( ".j-meter", this ).text()) >= parseInt(minSquare)) && (parseInt($( ".j-meter", this ).text()) <= parseInt(maxSquare)) &&
                        (parseInt($( ".j-price", this ).text()) >= parseInt(minPrice)) && (parseInt($( ".j-price", this ).text()) <= parseInt(maxPrice));
                  })
                    .removeClass('flat-invisible');

                }

                

                var fCount = filtered.length;
                $('.flat-total').text(fCount);

        });

        $(".apartment-choice-form form").submit(function (e) {
                e.preventDefault();
                var irooms = parseInt($('.apartment-choice-form').find( "input:radio[name=count]:checked" ).val());

                var minSquare = 1;
                var maxSquare = 9999;
                var minPrice = 1;
                var maxPrice = 9999999;

                if($('.sq-min').val()){
                     minSquare = $('.sq-min').val();
                }

                if($('.sq-max').val()){
                     maxSquare = $('.sq-max').val();  
                }

                if($('.p-min').val()){
                     minPrice = $('.p-min').val(); 
                }

                if($('.p-max').val()){
                     maxPrice = $('.p-max').val();
                }

                

                var flats = $('.one-flat');

                flats.addClass('flat-invisible');


               if(irooms === 0){

                    // console.log(irooms);

                    var filtered = $( flats )
                  .filter(function( index ) {

                    return true && 
                        (parseInt($( ".j-meter", this ).text()) >= parseInt(minSquare)) && (parseInt($( ".j-meter", this ).text()) <= parseInt(maxSquare)) &&
                        (parseInt($( ".j-price", this ).text()) >= parseInt(minPrice)) && (parseInt($( ".j-price", this ).text()) <= parseInt(maxPrice));
                  })
                    .removeClass('flat-invisible');

                } else if(irooms !== 0){

                    console.log(irooms);

                    var filtered = $( flats )
                  .filter(function( index ) {

                    return (parseInt($( ".j-room", this ).text()) === irooms) && 
                        (parseInt($( ".j-meter", this ).text()) >= parseInt(minSquare)) && (parseInt($( ".j-meter", this ).text()) <= parseInt(maxSquare)) &&
                        (parseInt($( ".j-price", this ).text()) >= parseInt(minPrice)) && (parseInt($( ".j-price", this ).text()) <= parseInt(maxPrice));
                  })
                    .removeClass('flat-invisible');

                }

                // var filtered = $( flats )
                //   .filter(function( index ) {

                //     return ($( ".j-room", this ).text() === irooms) && 
                //         (parseInt($( ".j-meter", this ).text()) >= parseInt(minSquare)) && (parseInt($( ".j-meter", this ).text()) <= parseInt(maxSquare)) &&
                //         (parseInt($( ".j-price", this ).text()) >= parseInt(minPrice)) && (parseInt($( ".j-price", this ).text()) <= parseInt(maxPrice));
                //   })
                //     .removeClass('flat-invisible');

                var fCount = filtered.length;
                $('.flat-total').text(fCount);
        
            });


        var total = $('.home-slider-item').length;
        $('.total').text(total-1);

        $('.home-slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
          var curr = $('.home-slider').slick('slickCurrentSlide');
          $('.curr').text(curr + 1);
        });

        new WOW().init();

       

        $('.home-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: ".home-slider-left",
            nextArrow: ".home-slider-right",
            dots: true,
            responsive: [{
                breakpoint: 1025,
                settings: {
                    arrows: false
                }
            }]
        });

        $('.inner-tabs-caption-li').first().addClass('active');
        $('.inner-tabs-content').first().addClass('active');

        $('ul.tabs__caption.inner-tabs-caption').on('click', '.inner-tabs-caption-li:not(.active)', function () {
            $(this).addClass('active').siblings().removeClass('active').closest('.inner-tabs').find('.inner-tabs-content').removeClass('active').eq($(this).index()).addClass('active');
        });

        

        $('ul.tabs__caption.tabs__caption-outer').on('click', '.tabs-li:not(.active)', function () {
            $(this).addClass('active').siblings().removeClass('active').closest('.tabs-outer').find('.tabs__content-outer').removeClass('active').eq($(this).index()).addClass('active');
        });

        $('.single-complex-slider').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: false,
            centerMode: false,
            prevArrow: ".single-complex-slider-prev",
            nextArrow: ".single-complex-slider-next",
            variableWidth: true,
            responsive: [{
                breakpoint: 560,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    variableWidth: false,
                    centerMode: false
                }
            }]
        });

        var mysection = $('.anim-section');

        var screen = $('.screen-section');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.header-main').addClass('fixed-header');
            } else {
                $('.header-main').removeClass('fixed-header');
            }
        });

        if ($('body').hasClass('home-p')) {
            $(window).scroll(function () {
                

                var id_curr = '#' + screen.filter(function (index) {
                    return checkVisibility($(this));
                }).attr('id');
                console.log(id_curr);
                if ($(window).scrollTop() > $(id_curr).height() / 2 && $(window).scrollTop() > 100 && id_curr) {
                    $('.aside-nav').find('li').removeClass('current');
                    $('.aside-nav').find('li a').filter(function (index) {
                        return $(this).attr('href') == id_curr;
                    }).closest('li').addClass('current');
                }

                if ($(window).scrollTop() < 100) {
                    $('.aside-nav').find('li').removeClass('current');
                    $('.aside-nav').find('li').first().addClass('current');
                }
            });
        };

        if ($('body').hasClass('home-p')) {

            var myDiv = $('#floating-box');

        if (myDiv) {

            if (checkVisibility(myDiv)) {
                $('.photo-wrap').addClass('photo-wrap-act');
                $('.about-me-text-wrap').addClass('about-me-text-wrap-act');
                $('#floating-box').addClass('floating-box-visible');
                $('.about-me-text-wrap').addClass('about-me-text-wrap-up');
            }
        }

        }

        

        //wheel media

        var mql = window.matchMedia('all and (min-width: 1025px)');

        var timedEvent;

        function addOnWheel(elem1, handler) {
            if (elem1.addEventListener) {
                if ('onwheel' in document) {
                    // IE9+, FF17+
                    elem1.addEventListener("wheel", handler);
                } else if ('onmousewheel' in document) {
                    // устаревший вариант события
                    elem1.addEventListener("mousewheel", handler);
                } else {
                    // 3.5 <= Firefox < 17, более старое событие DOMMouseScroll пропустим
                    elem1.addEventListener("MozMousePixelScroll", handler);
                }
            }
        }

        if (mql.matches) {

             $('.btn_anim').mouseenter(function () {
            $('.btn__second').addClass('anim1');
            $('.btn__second').removeClass('anim2');
        });

        $('.btn_anim').mouseleave(function () {
            $('.btn__second').removeClass('anim1');
            $('.btn__second').addClass('anim2');
        });

            var elem = document.getElementById('screen');

            if (elem !== null) {

                var myWheel = function myWheel(e) {

                    clearTimeout(timedEvent);

                    timedEvent = setTimeout(function () {

                        var delta = e.deltaY || e.detail || e.wheelDelta;
                        var act_secton = $('.section-active');
                        var act_num = act_secton.index('.screen-section');
                        if (delta > 0) {
                            act_num = act_num + 1;
                        } else {
                            act_num = act_num - 1;
                        }

                        if (act_num >= 0 && act_num < screen.length) {
                            $('.aside-nav').find('li').removeClass('current');
                            $('.screen-section').removeClass('section-active');
                            $('.anim-section').removeClass('section-inner-move');
                            $('.section-bg').removeClass('section-bg-move');
                            var q = $('.screen-section')[act_num];
                            $(q).addClass('section-active').children('.section-bg').addClass('section-bg-move');
                            $(q).find('.anim-section').addClass('section-inner-move');
                            $('.home-slider').slick('setPosition');
                            $('.aside-nav').find('li a').filter(function (index) {
                                return $(this).attr('href') == '#' + $(q).attr('id');
                            }).closest('li').addClass('current');
                        }

                        e.preventDefault();
                    }, 100);
                };

                

                $('.aside-nav a').on('click', function () {
                    $('.section-bg').removeClass('section-bg-move');
                    $('.anim-section').removeClass('section-inner-move');
                    $(this).closest('ul').children('li').removeClass('current');
                    var sect_id = $(this).attr('href');
                    $('.screen-section').removeClass('section-active');
                    $(sect_id).addClass('section-active');
                    $('.home-slider').slick('setPosition');
                    $(sect_id).children('.section-bg').addClass('section-bg-move');
                    $(sect_id).find('.anim-section').addClass('section-inner-move');
                    $(this).closest('li').addClass('current');
                });

                addOnWheel(elem, myWheel);
            }
        }
    });
})(jQuery);