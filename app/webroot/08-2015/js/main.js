
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});
/*$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });
});*/
jQuery(document).ready(function($) {
    jQuery('#myModal').modal('show');
    jQuery('a.page-scroll').bind('click', function(event) {
        var $anchor = jQuery(this);
        $('html, body').stop().animate({
            scrollTop: jQuery($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

    jQuery('.navbar-collapse ul li a').click(function() {
        jQuery('.navbar-toggle:visible').click();
    });
    jQuery('.acerca-del-juego .no-padd-r').addClass("noView").viewportChecker({
        classToAdd: 'okView animated bounceInLeft',
        offset: 100
       });
    jQuery('.acerca-del-juego .no-padd-l').addClass("noView").viewportChecker({
        classToAdd: 'okView animated bounceInRight',
        offset: 100
       });
    jQuery('.section-premios .col-xs-4').addClass("noView").viewportChecker({
        classToAdd: 'okView animated flipInX',
        offset: 100
       });
});