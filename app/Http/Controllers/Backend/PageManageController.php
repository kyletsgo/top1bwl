<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;
use App\Services\Backend\PageManagementService;
use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\SiteManagementRepository;
use App\Repository\Backend\UserRepository;
use Auth;

class PageManageController extends Controller
{
    protected $pageManagementServ;
    protected $userSv;
    protected $pageManagementRepo;
    protected $siteManagementRepo;
    protected $userRepo;

    public function __construct(PageManagementService $siteManagementService,
                                UserService $userService,
                                PageManagementRepository $pageManagementRepository,
                                SiteManagementRepository $siteManagementRepository,
                                UserRepository $userRepository)
    {
        $this->pageManagementServ = $siteManagementService;
        $this->userSv = $userService;
        $this->pageManagementRepo = $pageManagementRepository;
        $this->siteManagementRepo = $siteManagementRepository;
        $this->userRepo = $userRepository;
    }

    /**
     * 列表頁
     *
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        if ($this->userSv->isAdminUser($user_id)) {
            $rows = $this->pageManagementServ->searchList(0, 15);
        } else {
            $site = $this->siteManagementRepo->getByUserId($user_id);
            $site_id = $site->site_id;
            $rows = $this->pageManagementServ->searchList($site_id, 15);
        }

        if (!$rows->isEmpty()) {
            foreach ($rows as &$row) {
                $site_id = $row->site_id;
                $site = $this->siteManagementRepo->getById($site_id);

                $user = $this->userRepo->getById($site->user_id);
                $row->nickname = $user->nickname;

//            $row->url = "http://localhost:8888/page/$folder_name/$row->page_id";
                $row->url = "https://realleaftaiwan.our-work.com.tw/page/$site->folder_name/$row->page_id";
            }
        }

        return view('admin.page_manage.list', [
            'rows' => $rows,
        ]);
    }

    /**
     * 選擇版型頁
     *
     */
    public function selectTemplatePage()
    {
        return view('admin.page_manage.create_select_template');
    }

    /**
     * 新增頁
     *
     */
    public function createPage(Request $request)
    {
        $template_id = $request->input('template');

        $template = $this->pageManagementRepo->getTemplate($template_id);
        $content = $template->content;

        return view('admin.page_manage.create', [
            'content' => $content
        ]);
    }

    /**
     * 新增
     *
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $site = $this->siteManagementRepo->getByUserId($user_id);
        $site_id = $site->site_id;

        $this->pageManagementServ->createItem($request, $site_id);

        return redirect('/backend/page_manage');
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->pageManagementServ->getEditItem($id);

        return view('admin.page_manage.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $id = $this->pageManagementServ->updateItem($request);

        return redirect('/backend/page_manage/edit/' . $id);
    }

}
