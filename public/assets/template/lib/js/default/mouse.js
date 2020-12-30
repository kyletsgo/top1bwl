
var open1 = true;

if (isMobile()) {
} else {
    $('.hover_btn')
        .on('mouseover', function (e) {
            if(open1) {
                $(this).addClass("hover_btn-active");
                open1 = false;
            }
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
            $(this).find('.hover').css({
                top: relY,
                left: relX
            })
        })
        .on('mouseout', function (e) {
            if(!open1) {
                $(this).removeClass("hover_btn-active");
                open1 = true;
            }
            var parentOffset = $(this).offset(),
                relX = e.pageX - parentOffset.left,
                relY = e.pageY - parentOffset.top;
            $(this).find('.hover').css({
                top: relY,
                left: relX
            })
        });
        /*
    $('[href=#]').click(function () {
        return false
    });
    */
}
