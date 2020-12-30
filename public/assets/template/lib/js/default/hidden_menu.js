$(function () {
    var prev;
    scrollboolean = true;
    $(window).on('scroll', function () {
        var scrollTop = $(window).scrollTop() + ($(window).height()/2);
        if (scrollTop > $("#cut4").offset().top) {
            $(".count").addClass('count--active');
            $(".floatBtn").addClass('floatBtn--active');
        } else {
            $(".count").removeClass('count--active');
            $(".floatBtn").removeClass('floatBtn--active');
        }
        // if (scrollTop > 0) {
        //     $(".header__bg").toggleClass('header__bg--active', scrollTop > prev);
        //     prev = scrollTop;
        // }
    });
});