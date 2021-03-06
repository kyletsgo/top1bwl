<?php

namespace App\Services\Web;

use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\PromoManagementRepository;
use App\Repository\Backend\CalendarManagementRepository;

class PageService
{
    protected $pageManagementRepo;
    protected $promoManagementRepo;
    protected $calendarManagementRepo;

    public function __construct(PageManagementRepository $siteManagementRepository,
                                PromoManagementRepository $promoManagementRepository,
                                CalendarManagementRepository $calendarManagementRepository)
    {
        $this->pageManagementRepo = $siteManagementRepository;
        $this->promoManagementRepo = $promoManagementRepository;
        $this->calendarManagementRepo = $calendarManagementRepository;
    }

    public function getPage($page_id)
    {
        return $this->pageManagementRepo->getById($page_id);
    }

    public function getMenuItemsHtml($folder_name, $isSubdomain = false)
    {
        $pages = $this->pageManagementRepo->getAllPagesByFolderName($folder_name);

        $li_items = '';
        foreach ($pages as $page) {
            if ($isSubdomain) {
                $li_items .= '<li>' . '<a href="'. url("/page/$page->page_id") .'">' . $page->title . '</a> ' . '</li>';
            } else {
                $li_items .= '<li>' . '<a href="'. url("/page/$folder_name/$page->page_id") .'">' . $page->title . '</a> ' . '</li>';
            }

        }

        $menu_items = '<div class="header__menu" id="menuList"><ul>' . $li_items . '</ul></div>';

        return $menu_items;
    }

    public function getCalendarItemHtml()
    {
        $item = $this->calendarManagementRepo->getCalendar();

        return '<div class="images images__half">
            <div class="images__content">
                <picture>
                    <!-- 手機版 -->
                    <source srcset="' . url($item->image_small) . '" media="(max-width: 767.8px)">
                    <!-- 電腦版 -->
                    <source srcset="' . url($item->image_large) . '" media="(min-width: 768px)">
                    <!-- 預設 -->
                    <img src="/assets/template/images/banner1 (1).jpg">
                </picture>
            </div>
        </div>';
    }

    public function getFormItemHtml()
    {
        return '<div class="form">
                <div class="form__content">
                    <h2 class="content__title">想了解我團隊優勢及合作方式，歡迎留下聯絡方式，方便聯繫您</h2>
                    <form class="content__group" id="myForm">
                        <div class="group__input">
                            <label for="email">電子郵件地址：</label>
                            <input type="text" name="email" id="email" placeholder="請輸入電子郵件地址">
                        </div>
                        <div class="group__input">
                            <label for="name">姓名：</label>
                            <input type="text" name="name" id="name" placeholder="請輸入姓名">
                        </div>
                        <div class="group__input">
                            <label for="Line">Line：</label>
                            <input type="text" name="Line" id="Line" placeholder="請輸入Line ID">
                        </div>
                        <div class="group__input">
                            <div id="recaptcha-demo" class="g-recaptcha"
                                 data-sitekey="6LduDz4aAAAAAHUVDMxEaaWKWLQpwJG1iy6l7cHH">
                            </div>
                            <script src="https://www.google.com/recaptcha/api.js"></script>
                        </div>
                        <a class="group__submit" id="myFormSubmit" href="javascript:void(0)">送出</a>
                    </form>
                </div>
            </div>';
    }

    public function getFloatBtnItemHtml($line_friend_link, $fb_friend_link)
    {
        return '<div class="floatBtn">
                    <a class="fb" href="' . $fb_friend_link . '">
                        <img src="/assets/template/images/facebook.png" alt="">
                        <p>線上諮詢</p>
                    </a>
                    <a class="line" href="' . $line_friend_link . '">
                        <img src="/assets/template/images/LINE_APP_RGB_20190219-02.png" alt="">
                        <p>線上諮詢</p>
                    </a>
                </div>';
    }

    public function getPromoItemHtml()
    {
        $items = $this->promoManagementRepo->getAllPromo();

        $li_items = '';
        $default_image_url = '';
        foreach ($items as $item) {
            $li_items .= '<a class="swiper-slide sale__open" data-img="' . $item->image_url . '" href="javascript:void(0)">' . $item->title . '</a>' . "\n";

            if ($item->isDefault === 1) {
                $default_image_url = $item->image_url;
            }
        }

        $show_sale_popup = empty($default_image_url) ? '' : ' sale__popup--active ';

        $menu_items = '<div class="sale">
                <div class="swiper-container sale__bar">
                    <div class="swiper-wrapper">'. $li_items .'</div>
                </div>
                <div class="sale__popup '. $show_sale_popup .'" id="sale__popup">
                    <div class="sale__box" id="sale__box" style="background-image: url('.$default_image_url.')">
                        <a class="sale__close" id="sale__close" href="javascript:void(0)">
                            <span>&nbsp</span>
                            <span>&nbsp</span>
                        </a>
                    </div>
                </div>
            </div>';

        return $menu_items;
    }
}