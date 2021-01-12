<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Web\PageService;
use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\LineManagementRepository;
use Log;

class PageController extends Controller
{
    protected $pageServ;
    protected $pageManagementRepo;
    protected $lineManagementRepo;

    public function __construct(PageService $pageService,
                                PageManagementRepository $pageManagementRepository,
                                LineManagementRepository $lineManagementRepository)
    {
        $this->pageServ = $pageService;
        $this->pageManagementRepo = $pageManagementRepository;
        $this->lineManagementRepo = $lineManagementRepository;
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
        $add_friend_link = $this->lineManagementRepo->getLineLinkBySiteId($site_id);

        $menu_items = $this->pageServ->getMenuItemsHtml($folder_name);
        $form_item = $this->pageServ->getFormItemHtml();
        $floatBtn_item = $this->pageServ->getFloatBtnItemHtml($add_friend_link);

        $page_content = str_replace("<menu_items></menu_items>", $menu_items, $page_content);
        $page_content = str_replace("<form_item></form_item>", $form_item, $page_content);
        $page_content = str_replace("<floatbtn_item></floatbtn_item>", $floatBtn_item, $page_content);

        return view('web.page', [
            'page_content' => $page_content,
            'site_id' => $page->site_id
        ]);
    }

    public function saveForm(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $line = $request->input('Line');
        $site_id = $request->input('site_id');

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
