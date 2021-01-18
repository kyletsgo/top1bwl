<?php

namespace App\Services\Web;

use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\PromoManagementRepository;
use App\Repository\Backend\PromoteFormRepository;

class PageService
{
    protected $pageManagementRepo;
    protected $promoManagementRepo;

    public function __construct(PageManagementRepository $siteManagementRepository,
                                PromoManagementRepository $promoManagementRepository)
    {
        $this->pageManagementRepo = $siteManagementRepository;
        $this->promoManagementRepo = $promoManagementRepository;
    }

    public function getPage($page_id)
    {
        return $this->pageManagementRepo->getById($page_id);
    }

    public function getMenuItemsHtml($folder_name)
    {
        $pages = $this->pageManagementRepo->getAllPagesByFolderName($folder_name);

        $li_items = '';
        foreach ($pages as $page) {
//            $li_items .= '<li>' . '<a href="http://localhost:8888/page/'. $folder_name . '/' . $page->page_id . '">' . $page->title . '</a> ' . '</li>';
            $li_items .= '<li>' . '<a href="https://realleaftaiwan.our-work.com.tw/page/'. $folder_name . '/' . $page->page_id . '">' . $page->title . '</a> ' . '</li>';
        }

        $menu_items = '<div class="header__menu" id="menuList"><ul>' . $li_items . '</ul></div>';

        return $menu_items;
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
                        <a class="group__submit" id="myFormSubmit" href="javascript:void(0)">送出</a>
                    </form>
                </div>
            </div>';
    }

    public function getFloatBtnItemHtml($add_friend_link)
    {
        return '<div class="floatBtn">
                    <a href="' . $add_friend_link . '">
                        <img src="/assets/template/images/LINE_APP_RGB_20190219-02.png" alt="">
                        <p>加好友</p>
                    </a>
                </div>';
    }

    public function getPromoItemHtml()
    {
        $items = $this->promoManagementRepo->getAllPromo();

        $li_items = '';
        foreach ($items as $item) {
            $li_items .= '<a class="swiper-slide sale__open" data-img="' . url($item->image) . '" href="javascript:void(0)">' . $item->title . '</a>';
        }

        $menu_items = '<div class="sale">
                <div class="swiper-container sale__bar">
                    <div class="swiper-wrapper">'. $li_items .'</div>
                </div>
                <div class="sale__popup sale__popup--active" id="sale__popup">
                    <div class="sale__box" id="sale__box" style="background-image: url(../../images/S__104251397.jpg)">
                        <a class="sale__close" id="sale__close" href="javascript:void(0)">
                            <span></span>
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>';

        return $menu_items;
    }
}