tracker = function () {

    function track_ButtonClick(_key) {
        fbq('track', 'S7_BTN', {
            Content_name: '_key'
        });
        // console.log(_name + "-Click: " + _key);
    }
    function media_ButtonClick(_key) {
        gtag('event', 'conversion', {
            'allow_custom_scripts': true,
            'send_to': 'DC-8951671/s89wf0/'+_key+'+standard'
        });
        $("#trackMedia").attr("src", "https://ad.doubleclick.net/ddm/activity/src=8951671;type=s89wf0;cat="+_key+";dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?")
        // console.log(_name + "-Click: " + _key);
    }
    function shop_ButtonClick(_key) {
        gtag('event', 'conversion', {
            'allow_custom_scripts': true,
            'send_to': 'DC-8951671/'+_key+'/s7ann0+standard'
        });
        $("#trackMedia").attr("src", "https://ad.doubleclick.net/ddm/activity/src=8951671;type="+_key+";cat=s7ann0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;ord=1?")
        // console.log(_name + "-Click: " + _key);
    }
    /* GA default */

    /* Demo : data-category="footer" data-ga="privacy" */
    function page_track() {
        $(document).on("click", "*[data-track]", function () {
            track_ButtonClick($(this).data("track"));            // console.log($(this).data("track"));
        });
        $(document).on("click", "*[data-media]", function () {
            media_ButtonClick($(this).data("media"));
            // console.log($(this).data("track"));
        });
        $(document).on("click", "*[data-shop]", function () {
            shop_ButtonClick($(this).data("shop"));
            // console.log($(this).data("track"));
        });
        $(document).on("click", "*[data-iframe]", function () {
            $("#iframeMedia").attr("name", $(this).data("name"))
            $("#iframeMedia").attr("src", "https://insight.adsrvr.org/tags/t9hbv8d/"+$(this).data("iframe")+"/iframe")
            // console.log($(this).data("track"));
        });
    }

    function init() {
        page_track()
    }
    {
        init();
    }
    return {
        // pageView: function (_key) {
        //     gtag_pageView(_key)
        // },
        // ButtonClick: function (_name, _key) {
        //     gtag_ButtonClick(_name, _key)
        // },
        // Event: function (_name, _key) {
        //     gtag_Event(_name, _key)
        // },
    };
}

var setTracker = new tracker();

ga_default = function (_id) {
    /* GA default */
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', _id);

    function gtag_pageView(_key) {
        //ga('send', 'pageview', key);
        gtag('config', _id, {
            'page_title': _key,
            'page_path': '/' + _key
        });

        // console.log("pageView: " + _key);
    }

    function gtag_ButtonClick(_name, _key) {
        //ga('send', 'event', 'Button', 'Click', key);
        gtag('event', 'Click', {
            'event_label': _key
        });

        // console.log(_name + "-Click: " + _key);
    }
    function gtag_Event(_name, _key) {
        //ga('send', 'event', 'Button', 'Click', key);
        gtag('event', 'Event', {
            'event_category': _name,
            'event_label': _key
        });

        // console.log(_name + ":" + _key);
    }
    /* GA default */

    function page() {

    }

    /* Demo : data-category="footer" data-ga="privacy" */
    function page_ga() {
        $(document).on("click", "*[data-track]", function () {
            gtag_ButtonClick($(this).data("track"));
        });
    }

    function init() {
        page();
        page_ga()
    } {
        init();
    }
    return {
        pageView: function (_key) {
            gtag_pageView(_key)
        },
        ButtonClick: function (_name, _key) {
            gtag_ButtonClick(_name, _key)
        },
        Event: function (_name, _key) {
            gtag_Event(_name, _key)
        },
    };
}

var setGA = new ga_default("UA-6794788-17");