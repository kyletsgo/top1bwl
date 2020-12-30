
function socialShare(obj){

    var pageImage = $('meta[property="og:image"]').attr('content'); 
    var pageTitle = document.title; //HTML page title
    var pageUrl = obj.attr('data-href'); //Location of the page
    if(empty(pageUrl)){
        pageUrl = location.href; //Location of the page
    }
    var shareName = obj.attr('data-social'); //get the first class name of clicked element

    switch (shareName) //switch to different links based on different social name
    {
        case 'pinit':
            var openLink = 'http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(pageUrl) + '&media=' + encodeURIComponent(pageImage) + '&description=' + encodeURIComponent(pageTitle);
            break;
        case 'facebook':
            var openLink = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
            break;
        case 'twitter':
            var openLink = 'http://twitter.com/home?status=' + encodeURIComponent(pageTitle + ' ' + pageUrl);
            break;
        case 'digg':
            var openLink = 'http://www.digg.com/submit?phase=2&url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
            break;
        case 'stumbleupon':
            var openLink = 'http://www.stumbleupon.com/submit?url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
            break;
        case 'delicious':
            var openLink = 'http://del.icio.us/post?url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
            break;
        case 'google':
            var openLink = 'https://plus.google.com/share?url=' + encodeURIComponent(pageUrl) + '&title=' + encodeURIComponent(pageTitle);
            break;
        case 'email':
            var openLink = 'mailto:?subject=' + pageTitle + '&body=Found this useful link for you : ' + pageUrl;
            break;
    }

    //Parameters for the Popup window
    winWidth    = 650;  
    winHeight   = 450;
    winLeft     = ($(window).width()  - winWidth)  / 2,
    winTop      = ($(window).height() - winHeight) / 2, 
    winOptions   = 'width='  + winWidth  + ',height=' + winHeight + ',top='    + winTop    + ',left='   + winLeft;

    //open Popup window and redirect user to share website.
    window.open(openLink,'分享',winOptions);
    return false;

}