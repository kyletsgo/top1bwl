var areaWidth = $(".quiz__animate").width();
var areaHeight = $(".quiz__animate").height();

var centerPosX = areaWidth / 2;
var centerPosY = areaHeight / 2;

var parentOffset,
    relX,
    relY,
    transformX,
    transformY;

function isMobile() {

    try {
        document.createEvent("TouchEvent");
        return true;
    } catch (e) {
        return false;
    }

}

if (isMobile()) {
} else {
    $('.quiz__animate')
        .on('mouseout', function (e) {
            TweenMax.fromTo($(".layer__1"), 0.6, { x: transformX / 7, y: transformY / 7 }, { x: 0, y: 0 });
            TweenMax.fromTo($(".layer__2"), 0.6, { x: transformX / 10, y: transformY / 10 }, { x: 0, y: 0 });
            TweenMax.fromTo($(".layer__3"), 0.6, { x: transformX / 20, y: transformY / 20 }, { x: 0, y: 0 });
            TweenMax.fromTo($(".layer__4"), 0.6, { x: transformX / 30, y: transformY / 30 }, { x: 0, y: 0 });
        })
        .on('mousemove', function (e) {
            parentOffset = $(this).offset();
            relX = e.pageX - parentOffset.left;
            relY = e.pageY - parentOffset.top;
            transformX = relX - centerPosX;
            transformY = relY - centerPosY;

            TweenMax.set($(".layer__1"), { x: transformX / 7, y: transformY / 7 });
            TweenMax.set($(".layer__2"), { x: transformX / 10, y: transformY / 10 });
            TweenMax.set($(".layer__3"), { x: transformX / 20, y: transformY / 20 });
            TweenMax.set($(".layer__4"), { x: transformX / 30, y: transformY / 30 });
        });
}