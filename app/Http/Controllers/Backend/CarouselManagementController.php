<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\CarouselManagementService;
use App\Services\Backend\UserService;
use App\Repository\Backend\UserRepository;
use Auth;
use Storage;

class CarouselManagementController extends Controller
{
    protected $promoManagementSv;
    protected $userSv;
    protected $userRepo;

    public function __construct(CarouselManagementService $promoManagementService,
                                UserService $userService,
                                UserRepository $userRepository)
    {
        $this->promoManagementSv = $promoManagementService;
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
        $request->current_user = $this->userRepo->getById($user_id);

        $rows = $this->promoManagementSv->searchList($request, 15);

        return view('admin.carousel_management.list', [
            'rows' => $rows,
            'cond' => $request,
        ]);
    }

    /**
     * 新增頁
     */
    public function createPage()
    {
        return view('admin.carousel_management.create');
    }

    /**
     * 新增
     */
    public function create(Request $request)
    {
        $request->user_id = Auth::user()->id;

        $this->promoManagementSv->createItem($request);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->promoManagementSv->getEditItem($id);
        $items = json_decode($row->content);

        return view('admin.carousel_management.edit', [
            'row' => $row,
            'items' => $items
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $request->user_id = Auth::user()->id;

        $this->promoManagementSv->updateItem($request);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }

    /**
     * 刪除
     */
    public function delete(Request $request)
    {
        $itemId = $request->input('itemId');

        $this->promoManagementSv->deleteItem($itemId);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }
}
