/**
 * Created by egegen.com
 */
 jQuery(document).ready(function ($) {
    "use strict";
//===stickyHeader===
if ($.fn.tooltip) {
 $('[data-toggle="tooltip"]').tooltip();
}

//===fancybox===
if ($.fn.fancybox) {
    $('.fancybox').fancybox();
}

//===fancybox===
if ($.fn.dropdown) {
    $('.dropdown-toggle').dropdown()
}

//===dropdown===
if ($.fn.mask) {
    $("#phoneMask").mask("0 (999) 999 99 99");
    $("#dateMask").mask("99/99/9999");
}

//===jetmenu===
/*Jet Menu*/
if ($.fn.jetmenu) {
    var genislik = $(window).width()
    $("#jetmenu").jetmenu({
        mobileResolution: 959,
        indicatorChar: '<i class="fa fa-chevron-down"></i>'
    });
    if (genislik > 759) {
        $('.jetmenu li>a.alt-menu, .dropdown').mouseenter(function()
        {
            $('.menu-opacity').removeClass('d-none');
        });
        $('.jetmenu li>a.alt-menu, .dropdown').mouseleave(function()
        {
            $('.menu-opacity').addClass('d-none');
        });
    }
    else {
    }
}


//===flexslider===
if ($.fn.flexslider) {
   $('.flexslider').flexslider({
    prevText: "",
    nextText: "",
    animation: "fade",
    controlNav: true,
    directionNav:false
});
}

//===slick===
if ($.fn.slick) {
   $('.services-list .slick').slick({
    autoplay: true,
    arrows:false,
    dots:true,
    draggable: true,
    slidesToShow:6,
    slidesToScroll: 1,
    centerMode:false,
    responsive: [
    {
        breakpoint: 1281,
        settings: {
            slidesToShow: 5
        }
    },
    {
        breakpoint: 1200,
        settings: {
            slidesToShow: 3
        }
    },
    {
        breakpoint: 960,
        settings: {
            slidesToShow: 2
        }
    },
    {
        breakpoint: 720,
        settings: {
            slidesToShow: 2,
            arrows:false
        }
    },
    {
        breakpoint: 479,
        settings: {
            slidesToShow: 1,
            centerMode:false,
        }
    }
    ]
});
}

//===flexslider===
if ($.fn.slick) {
   $('.testimonial .slick').slick({
    autoplay: true,
    arrows:false,
    dots:true,
    draggable: true,
    slidesToShow:1,
    slidesToScroll: 1,
});
}


//===scroll-down===
if ($.fn.scrolldown) {
   $(".scroll-down a").on("click", function( e ) {
    e.preventDefault();
    $("body, html").animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 600);
});
}

//===checkbox-input===
if ($.fn.checkbox) {
    $('.checkbox-input input[type=checkbox]').attr('checked', false);
    $('.checkbox-input').click(function() {
        $(this).toggleClass('checked');
        $(this).find(':checkbox').prop('checked', ! $(this).find(':checkbox').prop('checked'));
    });
}

//===checkbox-input===


if ($.fn.custom) {
    $("section.content img").addClass('img-fluid');
}



if ($.fn.countTo) {
    var executed = false;
    $(window).scroll(function() {
        var hT = $('#scroll-to').offset().top,
        hH = $('#scroll-to').outerHeight(),
        wH = $(window).height(),
        wS = $(this).scrollTop();
        if (wS > (hT+hH-wH) && (hT > wS) && (wS+wH > hT+hH)){
            if (!executed) {
                executed = true;
                $('.timer').each(count);
                function count(options) {
                    var $this = $(this);
                    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                    $this.countTo(options);
                }
            }
        } else {
            $('.timer').stop();
        }
    });
}

$("#navigation").change(function()
{
    document.location.href = $(this).val();
});

});