/* 
    格式
    <div>
        <button id="one" data-id="M7lc1UVf-VE">Play 1!</button>
        <button id="two" data-id="JDYNOJJW2cU">Play 2!</button>
        <button id="three" data-id="4kLkSu6nGP4">Plays 3!</button>
    </div>
    <iframe id="player" src=""></iframe>

*/

Youtube_api = function (_name) {
    //  YouTube api 宣告
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";

    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    //  設定iframe參數
    var player;

    function youTubeReady() {
        player = new YT.Player(_name, {
            playerVars: {
                'rel': 0, //Don't show related videos
                'showinfo': 0, //Hide video info
                'autoplay': 1, // Autoplay when player is ready
                'loop': 0, //Loop the video
                'controls': 0, //Hide COntrols
                'playlist': '' //Needed for looping
            },
            events: {
                'onReady': onYouTubePlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onYouTubePlayerReady(event) {
        console.log(event.target.getVideoData());
    }

    function onPlayerStateChange(event) {
        switch (event.data) {
            case -1:
                // console.log('unstarted');
                break;
            case 0:
                console.log('video ended');
                break;
            case 1:
                console.log('video playing');
                // myfunction.ButtonClick("video","Video_play");
                break;
            case 2:
                console.log('video paused');
                break;
            case 3:
                // console.log('video buffering');
                break;
        }
        // console.log(player.getPlayerState());
    }

    {
        // $(document).on("click", "*[data-video]", function () {
        //     // $(".step3__video .video").html('<iframe id="' + _name + '" src="https://www.youtube.com/embed/' + $(this).attr("data-video") + '?enablejsapi=1" frameborder="0" allowfullscreen></iframe>');
        //     // $(".step3__video .video iframe").attr("src", 'https://www.youtube.com/embed/' + $(this).attr("data-video") + '?enablejsapi=1');
        //     if ($(this).attr("data-video") == "DtLCGPSQGrQ") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player1").show()
        //     } else if ($(this).attr("data-video") == "m09ffjBgpKo") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player2").show()
        //     } else if ($(this).attr("data-video") == "AI2ybCmMfw4") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player3").show()
        //     } else if ($(this).attr("data-video") == "OdbrjWOSTBM") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player4").show()
        //     } else if ($(this).attr("data-video") == "W1seJQtbNx4") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player5").show()
        //     } else if ($(this).attr("data-video") == "3rV55iD77Fg") {
        //         $(".step3__video .video iframe").hide();
        //         $("#player6").show()
        //     }
        //     $(".temp").hide();
        //     if ($(this).hasClass("tempVideo")) {
        //         $(".temp").show();
        //     }
        //     $(".video iframe").stopVideo();
        //     // youTubeReady();
        // });
        // $("button").click(function () {
        //     $("#" + _name).attr("src", "https://www.youtube.com/embed/" + $(this).attr("data-id") +
        //         "?enablejsapi=1");
        //     youTubeReady();
        // });
    }
    return {

    }
}
var myYoutube = new Youtube_api("player");

//  YouTube api 宣告
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";

var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
//  設定iframe參數
var player;

var players = new Array();

function onYouTubeIframeAPIReady() {
    players[0] = new YT.Player('player1', {
        videoId: 'DtLCGPSQGrQ'
    });
    players[1] = new YT.Player('player2', {
        videoId: 'm09ffjBgpKo'
    });
    players[2] = new YT.Player('player3', {
        videoId: 'AI2ybCmMfw4'
    });
    players[3] = new YT.Player('player4', {
        videoId: 'OdbrjWOSTBM'
    });
    players[4] = new YT.Player('player5', {
        videoId: 'W1seJQtbNx4'
    });
    players[5] = new YT.Player('player6', {
        videoId: 'sGnQFD1nnqo'
    });
}

$(document).on("click", "*[data-video]", function () {
    if ($(this).attr("data-video") == "DtLCGPSQGrQ") {
        $(".step3__video .video iframe").hide();
        $("#player1").show()
    } else if ($(this).attr("data-video") == "m09ffjBgpKo") {
        $(".step3__video .video iframe").hide();
        $("#player2").show()
    } else if ($(this).attr("data-video") == "AI2ybCmMfw4") {
        $(".step3__video .video iframe").hide();
        $("#player3").show()
    } else if ($(this).attr("data-video") == "OdbrjWOSTBM") {
        $(".step3__video .video iframe").hide();
        $("#player4").show()
    } else if ($(this).attr("data-video") == "W1seJQtbNx4") {
        $(".step3__video .video iframe").hide();
        $("#player5").show()
    } else if ($(this).attr("data-video") == "sGnQFD1nnqo") {
        $(".step3__video .video iframe").hide();
        $("#player6").show()
    }
    $(".temp").hide();
    if ($(this).hasClass("tempVideo")) {
        $(".temp").show();
    }
    $(players).each(function (i) {
        this.stopVideo();
    });
});