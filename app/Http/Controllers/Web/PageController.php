<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Web\PageService;
use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\LineManagementRepository;
use App\Repository\Backend\SiteManagementRepository;
use Log;

class PageController extends Controller
{
    protected $pageServ;
    protected $pageManagementRepo;
    protected $lineManagementRepo;
    protected $siteManagementRepo;

    public function __construct(PageService $pageService,
                                PageManagementRepository $pageManagementRepository,
                                LineManagementRepository $lineManagementRepository,
                                SiteManagementRepository $siteManagementRepository)
    {
        $this->pageServ = $pageService;
        $this->pageManagementRepo = $pageManagementRepository;
        $this->lineManagementRepo = $lineManagementRepository;
        $this->siteManagementRepo = $siteManagementRepository;
    }

    /**
     * 顯示頁面
     *
     */
    public function showPage($folder_name, $page_id)
    {
        // 取得 site head info


        // 取得 site content
        $page = $this->pageServ->getPage($page_id);
        $page_content = $page->content;
        $site_id = $page->site_id;
        list($line_friend_link, $fb_friend_link) = $this->lineManagementRepo->getLineLinkBySiteId($site_id);
        $site = $this->siteManagementRepo->getBySiteId($site_id);

        $menu_items = $this->pageServ->getMenuItemsHtml($folder_name);
        $calendar_item = $this->pageServ->getCalendarItemHtml();
        $form_item = $this->pageServ->getFormItemHtml();
        $floatBtn_item = $this->pageServ->getFloatBtnItemHtml($line_friend_link, $fb_friend_link);
        $promo_items = $this->pageServ->getPromoItemHtml();

        $page_content = str_replace("<menu_items></menu_items>", $menu_items, $page_content);
        $page_content = str_replace("<calendar_item></calendar_item>", $calendar_item, $page_content);
        $page_content = str_replace("<form_item></form_item>", $form_item, $page_content);
        $page_content = str_replace("<floatbtn_item></floatbtn_item>", $floatBtn_item, $page_content);
        $page_content = str_replace("<promo_items></promo_items>", $promo_items, $page_content);

        return view('web.page', [
            'page_content' => $page_content,
            'site_id' => $page->site_id,
            'site' => $site
        ]);
    }

    /**
     * 顯示頁面
     *
     */
    public function showHomePage()
    {
        // 取得 site content
        $page = $this->pageServ->getPage(1);
        $page_content = $page->content;
        $site_id = $page->site_id;
        list($line_friend_link, $fb_friend_link) = $this->lineManagementRepo->getLineLinkBySiteId($site_id);
        $site = $this->siteManagementRepo->getBySiteId($site_id);

        $menu_items = $this->pageServ->getMenuItemsHtml('admin');
        $calendar_item = $this->pageServ->getCalendarItemHtml();
        $form_item = $this->pageServ->getFormItemHtml();
        $floatBtn_item = $this->pageServ->getFloatBtnItemHtml($line_friend_link, $fb_friend_link);
        $promo_items = $this->pageServ->getPromoItemHtml();

        $page_content = str_replace("<menu_items></menu_items>", $menu_items, $page_content);
        $page_content = str_replace("<calendar_item></calendar_item>", $calendar_item, $page_content);
        $page_content = str_replace("<form_item></form_item>", $form_item, $page_content);
        $page_content = str_replace("<floatbtn_item></floatbtn_item>", $floatBtn_item, $page_content);
        $page_content = str_replace("<promo_items></promo_items>", $promo_items, $page_content);

        return view('web.page', [
            'page_content' => $page_content,
            'site_id' => $page->site_id,
            'site' => $site
        ]);
    }

    public function saveForm(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $line = $request->input('Line');
        $site_id = $request->input('site_id');

        $recaptcha = new \ReCaptcha\ReCaptcha('6LduDz4aAAAAAPYRXcV4EJB9qSw8kSHwFZPhak65');
        $resp = $recaptcha->verify($request->input('g-recaptcha-response'), $request->ip());
        if (!$resp->isSuccess()) {
            return response()->json([
                'code' => 99,
                'message' => '機器人驗證失敗，請重新再試。',
                'data' => [],
            ],200);
        }

        // get username by site_id
        $user_site = $this->pageManagementRepo->getUserSiteBySiteId($site_id);

        $this->pageManagementRepo->savePromoteForm($email, $name, $line, $user_site->username);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }

}
