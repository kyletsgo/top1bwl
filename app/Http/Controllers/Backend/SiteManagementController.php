<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\SiteManagementService;
use App\Services\Backend\UserService;
use Auth;

class SiteManagementController extends Controller
{
    protected $siteManagementServ;
    protected $userSv;

    public function __construct(SiteManagementService $siteManagementService,
                                UserService $userService)
    {
        $this->siteManagementServ = $siteManagementService;
        $this->userSv = $userService;
    }

    /**
     * 列表頁
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $isAdmin = $this->userSv->isAdminUser($user_id);

        if (!$isAdmin) {
            $request->user_id = $user_id;
        }

        $rows = $this->siteManagementServ->searchList($request, 15);

        return view('admin.site_management.list', [
            'rows' => $rows,
            'cond' => $request,
            'isAdmin' => $isAdmin,
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
