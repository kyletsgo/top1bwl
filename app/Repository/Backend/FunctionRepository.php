<?php
namespace App\Repository\Backend;

use App\Functions;
use Illuminate\Http\Request;
use Auth;

class FunctionRepository
{
    /**
     * 建構子
     */
    public function __construct()
    {
    }

    /**
     * 取得所有功能
     *
     * @return Functions
     */
    public function getAllFunctions($menuId = null)
    {
        if (is_null($menuId))
        {
            return Functions::all();
        }
        else
        {
            return Functions::where('menu_id', $menuId)->get();
        }
    }

    /**
     * 取得單一功能資料
     *
     * @param integer $id
     * @return Functions
     */
    public function getFunction($id = 0)
    {
        return Functions::find($id);
    }

    /**
     * 更新功能
     *
     * @param Request $request
     * @param integer $id
     * @return bool
     */
    public function modifyFunction(Request $request, $id = 0)
    {
        $function = $this->getFunction($id);
        $function->menu_id = $request->menu_id;
        $function->name = $request->name;
        $function->link = $request->link;
        $function->description = $request->description;
        $function->order = $request->order;
        $function->valid = ($request->valid == 'on') ? 1 : 0;
        $function->oid = Auth::user()->id;
        $function->save();

        return true;
    }

    /**
     * 新增功能
     *
     * @param Request $request
     * @return integer
     */
    public function insertFunction(Request $request)
    {
        $function = new Functions();
        $function->menu_id = $request->menu_id;
        $function->name = $request->name;
        $function->link = $request->link;
        $function->description = $request->description;
        $function->order = $request->order;
        $function->valid = ($request->valid == 'on') ? 1 : 0;
        $function->oid = Auth::user()->id;
        $function->save();

        return $function->id;
    }

    /**
     * 移除功能
     *
     * @param integer $id
     * @return bool
     */
    public function deleteFunction($id = 0)
    {
        $function = $this->getFunction($id);
        $function->delete();

        return true;
    }

    /**
     * 取得多個功能
     *
     * @param array $functionIds
     * @return void
     */
    public function getFunctions($functionIds = array())
    {
        $result = Functions::whereIn('id', $functionIds)->get();

        return $result;
    }

    /**
     * 取得多個功能以外
     *
     * @param array $functionIds
     * @return void
     */
    public function getFunctionsNotIn($functionIds = array())
    {
        $result = Functions::whereNotIn('id', $functionIds)->get();

        return $result;
    }
}