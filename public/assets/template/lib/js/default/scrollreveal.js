// if (isMobile()) {
//     window.sr = ScrollReveal({
//         origin: "bottom",  // 起始位置
//         distance: "20px",  // 距離
//         duration: 100,  // 動畫時間
//         delay: 0,  // 動畫延遲時間
//         rotate: { x: 0, y: 0, z: 0 },  // 旋轉角度
//         //opacity: 0,  // 透明度
//         //scale: 0.9, // 縮放比例
//         easing: "cubic-bezier(0.6, 0.2, 0.1, 1)", // 動畫速度曲線
//         container: window.document.documentElement, // 外層
//         mobile: true, // 支援行動裝置
//         reset: false, // 每次都啟動動畫
//         useDelay: "always", // 延遲動畫次數
//         viewFactor: 0.3, // 當該物件在可視範圍內，則顯示此物件(0.2表示可視範圍20%)
//         //viewOffset: { top: 0, right: 0, bottom: 0, left: 0 }, // 當外層有設定間隔造成偏移，則請設定在此維持精準度
//         //beforeReveal: function (domEl) { console.log(1) }, // 當啟動顯示前，則執行此函式
//         //beforeReset: function (domEl) {console.log(2) }, // 當重啟前，則執行此函式
//         //afterReveal: function (domEl) {console.log(3) }, // 當啟動後，則執行此函式
//         //afterReset: function (domEl) {console.log(4) } // 當重啟後，則執行此函式
//     });
// } else {
//     window.sr = ScrollReveal({
//         origin: "bottom",  // 起始位置
//         distance: "20px",  // 距離
//         duration: 100,  // 動畫時間
//         delay: 0,  // 動畫延遲時間
//         rotate: { x: 0, y: 0, z: 0 },  // 旋轉角度
//         //opacity: 0,  // 透明度
//         //scale: 0.9, // 縮放比例
//         easing: "cubic-bezier(0.6, 0.2, 0.1, 1)", // 動畫速度曲線
//         container: $(".wrap"), // 外層
//         mobile: true, // 支援行動裝置
//         reset: false, // 每次都啟動動畫
//         useDelay: "always", // 延遲動畫次數
//         viewFactor: 0.3, // 當該物件在可視範圍內，則顯示此物件(0.2表示可視範圍20%)
//         //viewOffset: { top: 0, right: 0, bottom: 0, left: 0 }, // 當外層有設定間隔造成偏移，則請設定在此維持精準度
//         //beforeReveal: function (domEl) { console.log(1) }, // 當啟動顯示前，則執行此函式
//         //beforeReset: function (domEl) {console.log(2) }, // 當重啟前，則執行此函式
//         //afterReveal: function (domEl) {console.log(3) }, // 當啟動後，則執行此函式
//         //afterReset: function (domEl) {console.log(4) } // 當重啟後，則執行此函式
//     });
// }
window.sr = ScrollReveal({
    origin: "bottom", // 起始位置
    distance: "20px", // 距離
    duration: 100, // 動畫時間
    delay: 0, // 動畫延遲時間
    rotate: {
        x: 0,
        y: 0,
        z: 0
    }, // 旋轉角度
    //opacity: 0,  // 透明度
    //scale: 0.9, // 縮放比例
    easing: "cubic-bezier(0.6, 0.2, 0.1, 1)", // 動畫速度曲線
    container: window.document.documentElement, // 外層
    mobile: true, // 支援行動裝置
    reset: true, // 每次都啟動動畫
    useDelay: "always", // 延遲動畫次數
    viewFactor: 0.1, // 當該物件在可視範圍內，則顯示此物件(0.2表示可視範圍20%)
    //viewOffset: { top: 0, right: 0, bottom: 0, left: 0 }, // 當外層有設定間隔造成偏移，則請設定在此維持精準度
    //beforeReveal: function (domEl) { console.log(1) }, // 當啟動顯示前，則執行此函式
    //beforeReset: function (domEl) {console.log(2) }, // 當重啟前，則執行此函式
    //afterReveal: function (domEl) {console.log(3) }, // 當啟動後，則執行此函式
    //afterReset: function (domEl) {console.log(4) } // 當重啟後，則執行此函式
});
sr.reveal('.show', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
});
sr.reveal('.show-d1', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 150
});
sr.reveal('.show-d2', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 300
});
sr.reveal('.show-d3', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 450
});
sr.reveal('.show-d4', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 600
});

sr.reveal('.show-left', {
    origin: 'left',
    distance: '50px',
    duration: 1500,
});
sr.reveal('.show-right', {
    origin: 'right',
    distance: '50px',
    duration: 1500,
});
sr.reveal('.pop_show', {
    origin: 'bottom',
    distance: '30px',
    duration: 800,
    scale: 0.7,
    opacity: 0,
});
sr.reveal('.start', {
    origin: 'bottom',
    distance: '0px',
    duration: 800,
    easing: "cubic-bezier(.81,.39,.31,2.05)",
    scale: 1.3,
    opacity: 0,
});
sr.reveal('.start_click', {
    origin: 'bottom',
    distance: '50px',
    duration: 800,
    opacity: 0,
    delay: 600,
});
sr.reveal('.open1', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    beforeReveal: function (domEl) {
        $(".open1 .window").addClass("window--active");
    }, // 當啟動顯示前，則執行此函式
    beforeReset: function (domEl) {
        $(".open1 .window").addClass("window--active");
    }, // 當重啟前，則執行此函式
    afterReveal: function (domEl) {
        $(".open1 .window").removeClass("window--active");

    }, // 當啟動後，則執行此函式
    afterReset: function (domEl) {
        $(".open1 .window").removeClass("window--active");

     } // 當重啟後，則執行此函式
});
sr.reveal('.open2', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 150,
    beforeReveal: function (domEl) {
        $(".open2 .window").addClass("window--active");
    }, // 當啟動顯示前，則執行此函式
    beforeReset: function (domEl) {
        $(".open2 .window").addClass("window--active");
    }, // 當重啟前，則執行此函式
    afterReveal: function (domEl) {
        $(".open2 .window").removeClass("window--active");

    }, // 當啟動後，則執行此函式
    afterReset: function (domEl) {
        $(".open2 .window").removeClass("window--active");

     } // 當重啟後，則執行此函式
});
sr.reveal('.open3', {
    origin: 'bottom',
    distance: '50px',
    duration: 1000,
    delay: 300,
    beforeReveal: function (domEl) {
        $(".open3 .window").addClass("window--active");
    }, // 當啟動顯示前，則執行此函式
    beforeReset: function (domEl) {
        $(".open3 .window").addClass("window--active");
    }, // 當重啟前，則執行此函式
    afterReveal: function (domEl) {
        $(".open3 .window").removeClass("window--active");

    }, // 當啟動後，則執行此函式
    afterReset: function (domEl) {
        $(".open3 .window").removeClass("window--active");

     } // 當重啟後，則執行此函式
});