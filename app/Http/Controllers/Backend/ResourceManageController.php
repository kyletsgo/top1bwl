<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\ResourceManagementService;
use App\Services\Backend\UserService;
use App\Repository\Backend\UserRepository;
use App\Repository\Backend\ResourceManagementRepository;
use Auth;

class ResourceManageController extends Controller
{
    protected $resourceManagementSv;
    protected $userSv;
    protected $userRepo;
    protected $resourceManagementRepo;

    public function __construct(ResourceManagementService $resourceManagementService,
                                UserService $userService,
                                UserRepository $userRepository,
                                ResourceManagementRepository $resourceManagementRepository)
    {
        $this->resourceManagementSv = $resourceManagementService;
        $this->userSv = $userService;
        $this->userRepo = $userRepository;
        $this->resourceManagementRepo = $resourceManagementRepository;
    }

    /**
     * ckfinder
     *
     */
    public function ckfinder()
    {
        session_start();
        $_SESSION['CKFinder_UserRole'] = 'administrator';

        return view('admin.resource_manage.ckfinder',[
        ]);
    }

    /**
     * 列表頁
     */
    public function index(Request $request)
    {
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);

        // 顯示所有
        $rows = $this->resourceManagementSv->searchList(15);

        return view('admin.resource_manage.list', [
            'rows' => $rows,
            'cond' => $request,
            'current_user_role' => $current_user->role,
            'current_user_id' => $current_user->id,
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
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);

        $row = $this->resourceManagementSv->getEditItem($id);

        return view('admin.resource_manage.edit', [
            'row' => $row,
            'current_user_role' => $current_user->role,
            'current_user_id' => $current_user->id,
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

    /**
     * 刪除
     */
    public function delete(Request $request)
    {
        $itemId = $request->input('itemId');

        $this->resourceManagementRepo->delete($itemId);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }
}
