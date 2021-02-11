var salePopup = document.getElementById("sale__popup");
var saleBox = document.getElementById("sale__box");
var saleClose = document.getElementById("sale__close");

var swiper = new Swiper('.carousel__normal', {
    slidesPerView: 1,
    spaceBetween: 0,
    autoHeight: true,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.swiper-button-next1',
        prevEl: '.swiper-button-prev1',
    },
    breakpoints: {
        480: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
    }
});

var swiper1 = new Swiper('.sale__bar', {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    on: {
        init: function () {
            var sale = document.querySelectorAll(".sale__open");
            for (var i = 0; i < sale.length; i++) {
                sale[i].addEventListener('click', function (event) {
                    console.log(this.getAttribute("data-img"));
                    console.log(this);
                    salePopup.classList.toggle("sale__popup--active");
                    saleBox.style.backgroundImage = "url('" + this.getAttribute("data-img") + "')";
                });
            }
            saleClose.addEventListener('click', function () {
                salePopup.classList.toggle("sale__popup--active");
                saleBox.style.backgroundImage = "url('')";
            })
        },
    },
});