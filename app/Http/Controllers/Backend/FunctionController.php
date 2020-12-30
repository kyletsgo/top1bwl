<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FunctionController extends Controller
{
    protected $functionService, $menuService;

    /**
     * 建構子
     *
     * @param \App\Services\Backend\FunctionService $functionService
     * @param \App\Services\Backend\MenuService $menuService
     */
    public function __construct(\App\Services\Backend\FunctionService $functionService,
                                \App\Services\Backend\MenuService $menuService)
    {
        $this->functionService = $functionService;
        $this->menuService = $menuService;
    }

    /**
     * 列表
     *
     * @param integer $menuId
     * @return void
     */
    public function index($menuId = 0)
    {
        $functions = $this->functionService->getAllFunctions($menuId);
        $menu = $this->menuService->getMenu($menuId);

        $viewData = [
            'functions' => $functions,
            'menu' => $menu
        ];

        return view('admin.function.list', $viewData);
    }

    /**
     * 建立
     *
     * @param integer $menuId
     * @return void
     */
    public function create($menuId = 0)
    {
        $menu = $this->menuService->getMenu($menuId);

        $viewData = [
            'menu' => $menu
        ];

        return view('admin.function.create', $viewData);
    }

    /**
     * 編輯
     *
     * @param integer $menuId
     * @param integer $id
     * @return void
     */
    public function edit($menuId = 0, $id = 0)
    {
        $function = $this->functionService->getFunction($id);
        $menu = $this->menuService->getMenu($menuId);

        $viewData = [
            'function' => $function,
            'menu' => $menu
        ];

        return view('admin.function.edit', $viewData);
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
        $this->functionService->modifyFunction($request, $id);

        return redirect('/backend/menu/' . $request->menu_id . '/function/' . $id);
    }

    /**
     * 儲存
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $functionId = $this->functionService->insertFunction($request);

        return redirect('/backend/menu/' . $request->menu_id . '/function/' . $functionId);
    }

    /**
     * 刪除
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $this->functionService->deleteFunction($id);

        return redirect()->back();
    }
}
