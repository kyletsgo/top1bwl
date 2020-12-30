<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    protected $menuService;

    /**
     * 建構子
     *
     * @param \App\Services\Backend\MenuService $menuService
     */
    public function __construct(\App\Services\Backend\MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * 列表
     *
     * @return void
     */
    public function index()
    {
        $menus = $this->menuService->getAllMenus();

        $viewData = [
            'menus' => $menus,
        ];

        return view('admin.menu.list', $viewData);
    }

    /**
     * 建立
     *
     * @return void
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * 編輯
     *
     * @param integer $id
     * @return void
     */
    public function edit($id = 0)
    {
        $menu = $this->menuService->getMenu($id);

        $viewData = [
            'menu' => $menu
        ];

        return view('admin.menu.edit', $viewData);
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->menuService->modifyMenu($request, $id);

        return redirect('/backend/menu/' . $id);
    }

    /**
     * 儲存
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $menuId = $this->menuService->insertMenu($request);

        return redirect('/backend/menu/' . $menuId);
    }

    /**
     * 刪除
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $this->menuService->deleteMenu($id);

        return redirect()->back();
    }
}
