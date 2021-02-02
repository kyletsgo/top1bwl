<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\UserService;
use App\Services\Backend\SiteManagementService;
use App\Repository\Backend\UserRepository;
use Auth;

class UserController extends Controller
{
    protected $userSv;
    protected $siteManagementSv;
    protected $userRepo;

    public function __construct(UserService $userService,
                                SiteManagementService $siteManagementService,
                                UserRepository $userRepository)
    {
        $this->userSv = $userService;
        $this->siteManagementSv = $siteManagementService;
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

        if ($current_user->role === 1) {
            $rows = $this->userSv->searchList($current_user->username);
        } else {
            $rows = $this->userSv->searchList();
        }

        if ($current_user->role === 3) {
            $filtered_rows = $rows->filter(function ($item) use ($user_id) {
                return ($item->id === $user_id) || ($item->parent_user_id === $user_id);
            });
        } else {
            $filtered_rows = $rows;
        }

        return view('admin.user.list', [
            'rows' => $filtered_rows,
            'cond' => $request,
            'user_role' => $current_user->role,
        ]);
    }

    /**
     * 新增頁
     */
    public function createPage()
    {
        return view('admin.user.create');
    }

    /**
     * 新增
     */
    public function create(Request $request)
    {
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);

        // 新增會員
        $user = $this->userSv->createItem($request, $current_user);

        // 新增至一般會員群組
        $this->userSv->addUserToGroup($user->id, 1);

        // 建立網站
        $this->siteManagementSv->createItem($user);

        return redirect('/backend/user');
    }

    /**
     * 修改頁
     */
    public function editPage($id)
    {
        $row = $this->userSv->getEditItem($id);

        return view('admin.user.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     */
    public function edit(Request $request, $id)
    {
        $this->userSv->updateItem($request, $id);

        return redirect()->back()->with('success', '修改成功');
    }

    /**
     * 刪除
     */
    public function delete(Request $request)
    {
        $userId = $request->input('userId');

        $this->userSv->deleteItem($userId);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }

    /**
     * 下放權限
     */
    public function releaseAuth(Request $request)
    {
        $userId = $request->input('userId');

        $this->userSv->releaseAuthForUserId($userId);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }
}
