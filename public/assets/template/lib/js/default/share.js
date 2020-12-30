//share
// console.log(location.protocol+"//"+location.host+"/babygreetings/");
// console.log(location.search)
// alert('location.host: '+location.protocol+"//"+location.host+location.pathname);
// var ADD_ARRAY = ADD_URL.split('?');
var SHAREURL = location.protocol + "//" + location.host + "/babygreetings/app/api/";
// console.log(ADD_ARRAY[0]);
$(function () {
    $("a[data-ga='finish_fb']").click(function () {
        // ADD_URL = window.location.href;
        // ADD_ARRAY = ADD_URL.split('?');
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(SHAREURL + "Share.php?Platform=FB&ItemID=" + ITEMID + "&redirect_uri=https://www.nutrilon-event.com/babygreetings/"),
            'facebook-share-dialog',
            'width=600,height=600'
        );
        (window._bwq = window._bwq || []).push(['trackSingle', '821-139G445N0RCAECR', 'Contact', {
            'tags': ['contact_fb']
        }]);

    });
    $("a[data-ga='finish_line']").click(function () {
        // ADD_URL = window.location.href;
        // ADD_ARRAY = ADD_URL.split('?');
        // $("a[data-ga='line']").attr("href", "http://line.naver.jp/R/msg/text/?");
        window.open('https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(SHAREURL + "Share.php?Platform=Line&ItemID=" + ITEMID),
            'width=600,height=600'
        );
        (window._bwq = window._bwq || []).push(['trackSingle', '821-139G445N0RCAECR', 'Contact', {
            'tags': ['contact_line']
        }]);

    });

    $("a[data-ga='menu_fb']").click(function () {
        // ADD_URL = window.location.href;
        // ADD_ARRAY = ADD_URL.split('?');
        window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(SHAREURL + "Share.php?Platform=FB"),
            'facebook-share-dialog',
            'width=600,height=600'
        );
    });
    $("a[data-ga='menu_line']").click(function () {
        // ADD_URL = window.location.href;
        // ADD_ARRAY = ADD_URL.split('?');
        // $("a[data-ga='line']").attr("href", "http://line.naver.jp/R/msg/text/?");
        window.open('https://social-plugins.line.me/lineit/share?url=' + encodeURIComponent(SHAREURL + "Share.php?Platform=Line"),
            'width=600,height=600'
        );
    });
    // $("a[data-ga='in']").click(function () {
    //     window.open('http://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(url),
    //         'sharer',
    //         'toolbar=0, status=0, width=600, height=600');
    //     return false;
    // });
    $("*[data-link='0']").click(function (e) {
        e.preventDefault();
        window.location.href = location.protocol+"//"+location.host + "/2019/20191121-nutrilon-picture/" +$(this).attr('href')+location.search;
        // window.location.href = location.protocol + "//" + location.host + "/babygreetings/" + $(this).attr('href') + location.search;
        // console.log(location.protocol + "//" + location.host + "/babygreetings/" + $(this).attr('href') + location.search);
    });
})