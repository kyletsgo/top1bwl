<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\ResourceManagementService;
use App\Services\Backend\UserService;
use Auth;

class ResourceManageController extends Controller
{
    protected $resourceManagementSv;
    protected $userSv;

    public function __construct(ResourceManagementService $resourceManagementService,
                                UserService $userService)
    {
        $this->resourceManagementSv = $resourceManagementService;
        $this->userSv = $userService;
    }

    /**
     * ckfinder
     *
     */
    public function ckfinder()
    {
        return view('admin.resource_manage.ckfinder',[
        ]);
    }

    /**
     * 列表頁
     */
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $rows = $this->resourceManagementSv->searchList($user_id, 15);

        return view('admin.resource_manage.list', [
            'rows' => $rows,
            'cond' => $request,
        ]);
    }

    /**
     * 新增頁
     */
    public function createPage()
    {
        return view('admin.resource_manage.create');
    }

    /**
     * 新增
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->resourceManagementSv->createItem($request, $user_id);

        return redirect('/backend/resource_manage');
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->resourceManagementSv->getEditItem($id);

        return view('admin.resource_manage.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request, $id)
    {
        $id = $this->resourceManagementSv->updateItem($request, $id);

        return redirect('/backend/resource_manage/edit/' . $id);
    }
}
