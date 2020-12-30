<?php
namespace App\Repository\Backend;

use App\Menu;
use Illuminate\Http\Request;
use Auth;

class MenuRepository
{
    /**
     * 建構子
     */
    public function __construct()
    {

    }

    /**
     * 取得所有選單
     *
     * @return Menu
     */
    public function getAllMenus()
    {
        return Menu::all();
    }

    /**
     * 取得單一選單資料
     *
     * @param integer $id
     * @return Menu
     */
    public function getMenu($id = 0)
    {
        return Menu::find($id);
    }

    /**
     * 更新選單資料
     *
     * @param Request $request
     * @param integer $id
     * @return bool
     */
    public function modifyMenu(Request $request, $id = 0)
    {
        $menu = $this->getMenu($id);
        $menu->icon = $request->icon;
        $menu->name = $request->name;
        $menu->order = $request->order;
        $menu->valid =($request->valid == 'on') ? 1 : 0;
        $menu->oid = Auth::user()->id;
        $menu->save();

        return true;
    }

    /**
     * 新增選單
     *
     * @param Request $request
     * @return integer
     */
    public function insertMenu(Request $request)
    {
        $menu = new Menu();
        $menu->icon = $request->icon;
        $menu->name = $request->name;
        $menu->order = $request->order;
        $menu->valid = ($request->valid == 'on') ? 1 : 0;
        $menu->oid = Auth::user()->id;
        $menu->save();

        return $menu->id;
    }

    /**
     * 移除選單
     *
     * @param integer $id
     * @return bool
     */
    public function deleteMenu($id = 0)
    {
        $menu = $this->getMenu($id);
        $menu->delete();

        return true;
    }
}