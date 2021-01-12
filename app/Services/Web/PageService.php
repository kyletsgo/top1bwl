<?php

namespace App\Services\Web;

use App\Repository\Backend\PageManagementRepository;

class PageService
{
    protected $pageManagementRepo;

    public function __construct(PageManagementRepository $siteManagementRepository)
    {
        $this->pageManagementRepo = $siteManagementRepository;
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
}