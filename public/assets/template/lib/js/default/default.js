$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});


function isMobile() {

    try {
        document.createEvent("TouchEvent");
        return true;
    } catch (e) {
        return false;
    }

}
if (isMobile()) {
    console.log("此為行動裝置");
} else {
    console.log("非行動裝置");
}