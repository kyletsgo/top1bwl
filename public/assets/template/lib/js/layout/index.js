var pageIndex = 0;
var isShare = false;

var SHAREURL = "https://ibmsecurity.techorange.com/";
// var SHAREURL = location.protocol + "//" + location.host + "/";

var answerArray = ["資安新人式崩潰", "眼神死式崩潰", "切洋蔥式崩潰", "8+9式崩潰", "抓馬影帝式崩潰"];
var subArray = [
    "連續加班沒時間刮鬍子",
    "把上班當作功德",
    "生活多辛酸，就有多鼻酸",
    "不知不覺拳頭硬了起來",
    "如果能重來，不要當資安",
];
var pageIndex = 1;
var pageArray = ["index", "quiz", "result", "recommend", "form"];

var recommendTitle = [
    ["IBM QRadar Security<br>Intelligence Platform", "QRadar "],
    ["IBM X-Force Exchange", "X-Force Exchange "],
    ["IBM Security Guardium", "Security Guardium "],
    ["IBM Cloud Identity", "Cloud Identity "],
    ["IBM Cloud Pak for Security", "Cloud Pak for Security "]
];
var recommendContent = [
    ["AI感知並偵測詐騙、內鬼和進階威脅，立即將事件正規化並產⽣相互關聯。", "感知、追蹤並連結重⼤事件和威脅，並搭配Data Store授權提供日誌無限量儲存且強制執⾏資料隱私原則。", "從IBM X-Force提供專業即時威脅情報，能在本地或雲端環境中部署QRadar SIEM。"],
    ["監控超過250億個網頁是否有Web威脅，並由超過96,000個漏洞的資料庫作為支援。", "全球使用者可透過公開或私密群組共享研究、驗證威脅與研議攻擊回應計畫。", "提供API讓您無縫整合各式安全相關應用，包括支援開放式的標準環境。威脅預警直接串接使用。"],
    ["滿足企業合規報告和審計需求，企業需滿足合規和監管需求，包括:HIPA，PCI/DSS，以及歐盟法規GDPR等。", "完整保護整個企業環境內的敏感性資料。透過即時保護工具，降低員工從事非預期存取的風險，持續監控企業環境內存取，確保資料庫、資料倉儲、Hadoop、NoSQL以及檔共用庫等各種資料儲存系統的安全。", ""],
    ["所有裝置單一登入(SSO)，提供統一的應用程式啟動程式和SSO，以便從任何裝置都能單一登入任何應用程式。 ", "監測管理雲端使用，要求、核准、供應與重新認證使用者的應用程式存取。透過風險評分、法規遵循資料及URL位置來評估並瞭解雲端應用程式風險。", ""],
    ["在不移動資料的情況下獲得安全洞察。連接所有資料來源，以發現隱藏的威脅，無需移動資料、跨任何安全工具或者跨雲來搜索威脅。", "自動的快速回應安全事件，在統一的介面下把安全工作流程與自動規程連接起來，支援企業編排數百種常見安全場景的回應。", ""]
]

var saveResult = 0;

var phoneType = /^[0]{1}[9]{1}[0-9]{8}$/;
var mailType = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;;

var FORM_FAMILYNAME;
var FORM_GIVENNAME;
var FORM_PHONE;
var FORM_COMPANYSIZE;
var FORM_COMPANY;
var FORM_DEPT;
var FORM_JOB;
var FORM_EMAIL;

var email_verification;
var phone_verification;

function checkVal() {
    for (i = 0; i < 5; i++) {
        if (document.getElementById('check_' + i).checked) {
            saveResult++;
            pageIndex = i;
            $(".swiper-wrapper").append('<div class="recommend__slider swiper-slide"><div class="recommend__left"><p class="recommend__subtitle">防止繼續崩潰最重要</p><h3 class="recommend__en">' + recommendTitle[i][0] + '</h3><div class="recommend__area"><img class="plus" src="images/recommend_plus.png" alt=""><img class="frame" src="images/recommend/recommend_' + i + '.png" alt=""></div></div><div class="recommend__right"><div class="recommend__article"><h2 class="article__title">' + recommendTitle[i][1] + '<span>獨特之處</span></h2><div class="article__content"><p>' + recommendContent[i][0] + '</p><span class="gap"></span><p>' + recommendContent[i][1] + '</p><span class="gap"></span><p>' + recommendContent[i][2] + '</p></div></div></div></div>');
        }
    }
    if (saveResult == 0) {
        swiper.slideTo(0, 0);
        alert("請選擇至少一項");
        return;
    }
    if (saveResult < 2) {
        $(".recommend__prev").hide();
        $(".recommend__next").hide();
        $(".recommend__dots").hide()
    }
    // console.log(saveResult);
    $(".loading").fadeIn();
    $(".place__mask").show();
    $(".place").addClass("place--active")
    setTimeout(function () {
        onStep_2.leave();
    }, 2000)
    $(".result__title span").html(answerArray[saveResult - 1]);
    $(".result__sub .change").html(subArray[saveResult - 1]);
    $(".popup__form .frame").attr("src", "images/result/result_" + (saveResult - 1) + ".png");
    $(".result__content .frame").attr("src", "images/result/result_" + (saveResult - 1) + ".png");
    // $(".recommend__content .frame").attr("src", "images/result/result_"+(saveResult-1)+".png")
}

$(function () {
    $(".FormBtn").click(function () {
        $(".popup").fadeIn();
        setTimeout(function () {
            $(".popup__1").fadeIn()
        }, 200);
        isShare = true;
    });
    $(".popup__recommend--close").click(function() {
        $(".popup__1").fadeOut();
        setTimeout(function () {
            $(".popup").fadeOut()
        }, 200);
        isShare = false;
    })
    onStep_1.enter();
    $(".step-1 .next--page").click(function () {
        // $(".btn__area--box").addClass("hidden");
        // $(".step-2").removeClass("hidden");
        // $(".contentbox").eq(0)
        if (isMobile()) {
            onOri();
        } else {
            onStep_1.leave();
        }
    });
    $(".step-2 .next--page").click(function () {
        checkVal();
        // onStep_2.leave();
    });
    $(".step-3 .next--page").click(function () {
        TweenMax.fromTo($(".stage"), 1, {
            opacity: 0,
            scale: 1.2
        }, {
                opacity: 1,
                scale: 1
            })
        onStep_3.leave();
    });
    $(".step-4 .next--page").click(function () {
        $(".popup").fadeIn();
        setTimeout(function () {
            $(".popup__1").fadeIn()
        }, 200);
        setGA.pageView("gift_pop_up");
    });
    $(".toForm").click(function () {
        $("body").removeClass("body--active");
        $(".wrap").removeClass("wrap--fix");
        if (isShare && pageIndex != 4) {
            $(".popup").fadeOut()
            $(".popup__1").fadeOut()
            setGA.pageView("form");
            $("." + pageArray[pageIndex - 1]).hide();
            onStep_5.enter();
        } else if (isShare && pageIndex == 4) {
            $(".popup").fadeOut()
            $(".popup__1").fadeOut()
            onStep_4.leave();
            setGA.pageView("form");
        } else {
            $(".popup").fadeOut()
            $(".popup__1").fadeOut()
            onStep_4.leave();
            setGA.pageView("form");
        }
    });
    $(".step-5 .next--page").click(function () {
        FORM_FAMILYNAME = $("#familyName").val();
        FORM_GIVENNAME = $("#givenName").val();
        FORM_PHONE = $("#phone").val();
        FORM_COMPANY = $("#company").val();
        FORM_COMPANYSIZE = $("#scale").val();
        FORM_DEPT = $("#dept").val();
        FORM_JOB = $("#job").val();
        FORM_EMAIL = $("#email").val();

        email_verification = $("#byEmail").is(":checked") ? "NOT CHECKED" : "CHECKED";
        phone_verification = $("#byPhone").is(":checked") ? "NOT CHECKED" : "CHECKED";

        if (!FORM_FAMILYNAME) {
            alert("請輸入名稱");
        } else if (!FORM_GIVENNAME) {
            alert("請輸入姓氏");
        } else if (!FORM_PHONE) {
            alert("請輸入電話");
        } else if (!FORM_COMPANY) {
            alert("請輸入任職公司");
        } else if (!FORM_COMPANYSIZE) {
            alert("請選擇公司規模");
        } else if (!FORM_DEPT) {
            alert("請輸入公司部門");
        } else if (!FORM_JOB) {
            alert("請輸入職稱");
        } else if (!FORM_EMAIL) {
            alert("請輸入電子信箱");
        } else if (FORM_EMAIL.search(mailType) == -1) {
            alert("請輸入正確信箱格式");
        } else if (FORM_FAMILYNAME.match(/\d+/g) || FORM_GIVENNAME.match(/\d+/g)) {
            alert("姓名不得含有數字");
        } else {
            sendData()

            // $(".popup").fadeIn();
            // setTimeout(function () {
            //     $(".popup__2").fadeIn()
            // }, 200);
            // setGA.pageView("share");
        }
    });
    $(".toShare").click(function () {
        if (!isShare) {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(SHAREURL + "/share/share_" + (saveResult - 1) + ".html"),
                'facebook-share-dialog',
                'width=600,height=600'
            );
        } else {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(SHAREURL + "/share/share_" + getRandomInt(0, 4) + ".html"),
                'facebook-share-dialog',
                'width=600,height=600'
            );
        }
    });
});

function sendData() {
    $.ajax({
        url: "https://ibmsecurity.techorange.com/api/upload",
        dataType: "json",
        data: {
            "email": FORM_EMAIL,
            "first_name": FORM_FAMILYNAME,
            "last_name": FORM_GIVENNAME,
            "company": FORM_COMPANY,
            "company_size": FORM_COMPANYSIZE,
            "department": FORM_DEPT,
            "job_title": FORM_JOB,
            "phone": FORM_PHONE,
            "questionnum1_ooemail": "Q_XSYS:OOEMAIL",
            "email_verification": email_verification,
            "questionnum2_ootele": "Q_XSYS:OOTELE",
            "phone_verification": phone_verification
        },
        type: "POST",
        success: function (d) {
            if (d.status == 1) {
                alert("成功送出！");
                $(".popup").fadeIn();
                setTimeout(function () {
                    $(".popup__2").fadeIn()
                }, 200);
                setGA.pageView("share");
            }
        },
        error: function (e) {
            var err = JSON.parse(e.responseText);
            if (err.status == 0) {
                var message = "您的資料提交失敗";
                var error = err.message;
                var contact = "如有其他問題，請發送電子信件至 imailtw@tw.ibm.com，洽詢相關服務人員。"
                alert(message + "\n\n" + error + "\n\n" + contact);
            } else {
                alert("系統忙碌中，請稍候。")
            }
        }
    });
}



var step_1 = function () {
    function enter() {
        pageIndex = 1;
        $("body").animate({
            scrollTop: 0
        }, 500, 'swing', function () { });
        setGA.pageView("Home_page");
    }

    function leave() {
        $(".wrap").removeClass("wrap--fix");
        $("body").removeClass("body--active");
        bezierTween.totalProgress(1)
        $(".bg__content").css({
            "overflow": "hidden"
        });
        TweenMax.fromTo($(".bg__content"), .6, { width: "100%", height: "100%" }, { width: $(".index__border .frame").width() * 0.71 + "px", height: $(".index__border .frame").height() * 0.76 + "px" });
        TweenMax.fromTo($(".cut__1"), .6, { scale: 1 }, {
            scale: 0.7, onComplete: function () {
                $("#main__content").css({
                    "overflow": "hidden"
                });
                if (!isShare) {
                    onStep_2.enter();
                } else {
                    onStep_5.enter();
                }
                $(".index").addClass("pagePrev");
                $(".step-1").addClass("hidden");
            }
        });
        // onStep_2.enter();
        // $(".index").addClass("pagePrev");
        // $(".step-1").addClass("hidden");
    }

    function reset() {

    }

    return {
        enter: function () {
            enter();
        },
        leave: function () {
            leave();
        }
    };
}

var onStep_1 = new step_1();

var step_2 = function () {
    function enter() {
        pageIndex = 2;
        setTimeout(function () {
            $(".cover").fadeOut();
        }, 800)
        $("body").animate({
            scrollTop: 0
        }, 500, 'swing', function () { });
        $(".contentbox-2").removeClass("pageNext");
        $(".step-2").removeClass("hidden");
        openSwiper();
        setGA.pageView("test_1");
    }

    function leave() {
        $(".contentbox-2").addClass("pagePrev");
        $(".step-2").addClass("hidden");
    }

    function reset() {

    }

    return {
        enter: function () {
            enter();
        },
        leave: function () {
            leave();
            onStep_3.enter();
        }
    };
}

var onStep_2 = new step_2();

var step_3 = function () {
    function enter() {
        pageIndex = 3;
        $(".fullBg").hide();
        $("body").css({
            "background-image": "url(images/content__bg1.jpg)"
        })
        $("body").animate({
            scrollTop: 0
        }, 500, 'swing', function () { });
        $(".contentbox-3").removeClass("pageNext");
        $(".step-3").removeClass("hidden");
        setTimeout(function () {
            $(".loading").fadeOut();
        }, 900);
        setGA.pageView("result");
    }

    function leave() {
        $(".contentbox-3").addClass("pagePrev");
        $(".step-3").addClass("hidden");
        $(".wrap").addClass("wrap--active");
        setTimeout(function () {
            openRecommend();
            TweenMax.fromTo($(".recommend__column .left"), 0.6, { y: 50, opacity: 0 }, { y: 0, opacity: 1 });
            TweenMax.fromTo($(".recommend__column .right"), 0.6, { y: 50, opacity: 0 }, { y: 0, opacity: 1, delay: 0.2 })
        }, 700)
    }

    function reset() {

    }

    return {
        enter: function () {
            enter();
        },
        leave: function () {
            leave();
            onStep_4.enter();
        }
    };
}

var onStep_3 = new step_3();

var step_4 = function () {
    function enter() {
        pageIndex = 4;
        $("body").animate({
            scrollTop: 0
        }, 500, 'swing', function () { });
        $(".contentbox-4").removeClass("pageNext");
        $(".step-4").removeClass("hidden");
        setGA.pageView("recommend");
    }

    function leave() {
        $(".contentbox-4").addClass("pagePrev");
        $(".step-4").addClass("hidden");
    }

    function reset() {

    }

    return {
        enter: function () {
            enter();
        },
        leave: function () {
            leave();
            onStep_5.enter();
        }
    };
}

var onStep_4 = new step_4();

var step_5 = function () {
    function enter() {
        $(".FormBtn").fadeOut();
        pageIndex = 5;
        if (!isMobile) {
            $(".header").css({
                "padding": "3vh"
            })
            $("#main__content").css({
                "padding": "3vh"
            });
            $("#form__form2").css({
                "height": $("#form__form1").height() + "px"
            });
        }
        $(".wrap").addClass("wrap--active");
        $("body").animate({
            scrollTop: 0
        }, 500, 'swing', function () { });
        $(".contentbox-5").removeClass("pageNext");
        $(".step-5").removeClass("hidden");
        setGA.pageView("share");
    }

    function leave() {
        $(".contentbox-5").addClass("pagePrev");
        $(".step-5").addClass("hidden");
    }

    function reset() {

    }

    return {
        enter: function () {
            enter();
        },
        leave: function () {
            leave();
        }
    };
}

var onStep_5 = new step_5();

var bezierTween;
$(function () {
    var $ani = $(".cut__1");
    setTimeout(function () {
        TweenMax.set($ani, { xPercent: 8, yPercent: 12, scale: 1 });
    }, 600)
    TweenMax.fromTo($(".header"), 0.6, { opacity: 0 }, { opacity: 1 });
    TweenMax.fromTo($(".index__border .frame, .index__border .text"), 0.6, { scale: 1.1, opacity: 0 }, { scale: 1, opacity: 1, delay: 0.2 });
    TweenMax.fromTo($(".index__sub"), 0.6, { scale: 1.1, opacity: 0 }, { scale: 1, opacity: 1, delay: 0.4 });
    TweenMax.fromTo($("#click__1"), 0.6, { scale: 1.1, opacity: 0 }, {
        scale: 1, opacity: 1, delay: 0.6, onComplete: function () {
            bezierTween = new TweenMax($ani, 7, {
                bezier: {
                    type: "soft",
                    values: [{ xPercent: 8, yPercent: 12 }, { xPercent: -8, yPercent: 11 }, { xPercent: -16, yPercent: 9 }, { xPercent: 0, yPercent: -7 }, { xPercent: 0, yPercent: 0 }]
                },
                ease: Power1.easeInOut,
                // onUpdate: function() {
                //     console.log(this.progress()*100)
                //     if((this.progress()*100) > 20 && (this.progress()*100) < 40) {
                //         TweenMax.to(bezierTween, 0.6, {timeScale: 0.3})
                //     } else if((this.progress()*100) > 40 && (this.progress()*100) < 70) {
                //         TweenMax.to(bezierTween, 0.6, {timeScale: 1})
                //     } else if((this.progress()*100) > 70) {
                //         TweenMax.to(bezierTween, 0.6, {timeScale: 4})
                //     }
                // }
            });
        }
    });

    if(!isMobile()) {
        TweenMax.set('.fullBg', { css: { transformPerspective: 400, transformStyle: "preserve-3d" } });

        $(document).mousemove(function (e) {
            //$("span").text(e.pageX + ", " + e.pageY);
            var _d = (e.pageX - $(window).width() * .5) / ($(window).width() * .5);
            TweenMax.to('.fullBg', 0.2, { css: { rotationY: _d } });
        });
    }
})
