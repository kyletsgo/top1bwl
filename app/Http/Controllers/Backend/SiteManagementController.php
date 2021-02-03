<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\SiteManagementService;
use App\Services\Backend\UserService;
use App\Repository\Backend\UserRepository;
use Auth;

class SiteManagementController extends Controller
{
    protected $siteManagementServ;
    protected $userSv;
    protected $userRepo;

    public function __construct(SiteManagementService $siteManagementService,
                                UserService $userService,
                                UserRepository $userRepository)
    {
        $this->siteManagementServ = $siteManagementService;
        $this->userSv = $userService;
        $this->userRepo = $userRepository;
    }

    /**
     * 列表頁
     */
    public function index(Request $request)
    {
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);

        $rows = $this->siteManagementServ->searchList($current_user, $request, 15);

        return view('admin.site_management.list', [
            'rows' => $rows,
            'cond' => $request,
            'current_user_role' => $current_user->role,
        ]);
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->siteManagementServ->getEditItem($id);

        return view('admin.site_management.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $id = $this->siteManagementServ->updateItem($request);

        return redirect('/backend/site_management/edit/' . $id);
    }

    public function enableSite(Request $request)
    {
        $siteId = $request->input('siteId');

        $this->siteManagementServ->enableSite($siteId, 1);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }
}
