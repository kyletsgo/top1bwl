<?php
namespace App\Services\Backend;

use App\Repository as Repo;
use Illuminate\Http\Request;
use App\Presenter\MessagePresenter;

class MenuService
{
    //Menu Repository
    protected $function;

    /**
     * 建構子
     *
     * @param Repo\Backend\MenuRepository $menu
     */
    public function __construct(Repo\Backend\MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * 取得所有選單
     *
     * @return void
     */
    public function getAllMenus()
    {
        return $this->menu->getAllMenus();
    }

    /**
     * 取得選單
     *
     * @param integer $id
     * @return void
     */
    public function getMenu($id = 0)
    {
        return $this->menu->getMenu($id);   
    }

    /**
     * 新增選單
     *
     * @param Request $request
     * @return void
     */
    public function insertMenu(Request $request)
    {
        $validateRules = [
            'icon' => 'required',
            'name' => 'required|max:50',
            'order' => 'required|integer',
        ];

        $validateMessage = [
            'icon.required' => MessagePresenter::getRequired('圖示', 'option'),
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 50),
            'order.required' => MessagePresenter::getRequired('排序'),
            'order.integer' => MessagePresenter::getInteger('排序'),
        ];

        $request->validate($validateRules, $validateMessage);

        $menuId = $this->menu->insertMenu($request);

        return $menuId;
    }

    /**
     * 修改選單
     *
     * @param Request $request
     * @param integer $menuId
     * @return void
     */
    public function modifyMenu(Request $request, $menuId = 0)
    {
        $validateRules = [
            'icon' => 'required',
            'name' => 'required|max:50',
            'order' => 'required|integer',
        ];

        $validateMessage = [
            'icon.required' => MessagePresenter::getRequired('圖示', 'option'),
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 50),
            'order.required' => MessagePresenter::getRequired('排序'),
            'order.integer' => MessagePresenter::getInteger('排序'),
        ];

        $request->validate($validateRules, $validateMessage);

        $isSuccessful = $this->menu->modifyMenu($request, $menuId);

        return $isSuccessful;
    }

    /**
     * 刪除選單
     *
     * @param integer $menuId
     * @return void
     */
    public function deleteMenu($menuId = 0)
    {
        $menu = $this->menu->getMenu($menuId);

        foreach ($menu->functions() as $function)
        {
            $function->delete();
        }

        $isSuccessful = $this->menu->deleteMenu($menuId);

        return $isSuccessful;
    }
}