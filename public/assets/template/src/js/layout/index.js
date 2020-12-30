var menuAction = document.getElementById("menuToggle");
var menuList = document.getElementById("menuList");

var resizeState; // pc

function toggleAction() {
    menuAction.classList.toggle("menu--active");
    menuList.classList.toggle("header--hide");
}

function mobileState() {
    resizeState = false;
    menuAction.style.display = "block";
    menuList.classList.add("header--hide");
}

function pcState() {
    resizeState = true;
    menuAction.style.display = "none";
    menuAction.classList.remove("menu--active");
    menuList.classList.remove("header--hide");
}

function menuResize() {
    if(document.documentElement.clientWidth < 768) {
        resizeState = true;
        mobileState()
    } else {
        resizeState = false;
        pcState()
    }
}

function init() {
    var temp = document.querySelectorAll('.header')[0].offsetHeight
    document.querySelectorAll(".wrap")[0].style.paddingTop = temp + "px";
    // window.addEventListener('scroll', function (e) {
    //     if (document.documentElement.clientWidth < 768) return false;
    //     if (this.scrollY > 100) {
    //         if (resizeState) {
    //             mobileState()
    //         }
    //     } else {
    //         if (!resizeState) {
    //             pcState()
    //         }
    //     }
    // });
    // click
    menuAction.addEventListener('click', function () {
        toggleAction()
    })
}

init();