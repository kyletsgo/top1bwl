<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\PromoManagementService;
use App\Services\Backend\UserService;
use Auth;
use Storage;

class PromoManagementController extends Controller
{
    protected $promoManagementSv;
    protected $userSv;

    public function __construct(PromoManagementService $promoManagementService,
                                UserService $userService)
    {
        $this->promoManagementSv = $promoManagementService;
        $this->userSv = $userService;
    }

    /**
     * 列表頁
     */
    public function index(Request $request)
    {
        $rows = $this->promoManagementSv->searchList($request, 15);

        return view('admin.promo_management.list', [
            'rows' => $rows,
            'cond' => $request,
        ]);
    }

    /**
     * 新增頁
     */
    public function createPage()
    {
        return view('admin.promo_management.create');
    }

    /**
     * 新增
     */
    public function create(Request $request)
    {
        if ($request->hasFile('promoImage')) {
            $orig_image_name = 'promo-' . time() . '.jpg';
            $image_path = $request->promoImage->storeAs('promo', $orig_image_name, 'public');
            $request->image_url = Storage::url($image_path);
        }

        $request->user_id = Auth::user()->id;

        $this->promoManagementSv->createItem($request);

        return redirect('/backend/promo_management');
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->promoManagementSv->getEditItem($id);

        return view('admin.promo_management.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        if ($request->hasFile('promoImage')) {
            $orig_image_name = 'promo-' . time() . '.jpg';
            $image_path = $request->promoImage->storeAs('promo', $orig_image_name, 'public');
            $request->image_url = Storage::url($image_path);
        }

        $request->user_id = Auth::user()->id;

        $id = $this->promoManagementSv->updateItem($request);

        return redirect('/backend/promo_management/edit/' . $id);
    }
}
