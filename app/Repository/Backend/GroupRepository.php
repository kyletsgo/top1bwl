<?php
namespace App\Repository\Backend;

use App\Group;
use Illuminate\Http\Request;
use Auth;

class GroupRepository
{
    /**
     * 建構子
     */
    public function __construct()
    {
    }

    /**
     * 取得所有群組
     *
     * @return Group
     */
    public function getAllGroups()
    {
        return Group::all();
    }

    /**
     * 取得單一群組資料
     *
     * @param integer $id
     * @return Group
     */
    public function getGroup($id = 0)
    {
        return Group::find($id);
    }

    /**
     * 更新群組
     *
     * @param Request $request
     * @param integer $id
     * @return bool
     */
    public function modifyGroup(Request $request, $id = 0)
    {
        $group = $this->getGroup($id);
        $group->name = $request->name;
        $group->functions = $request->functions;
        $group->users = $request->users;
        $group->valid = ($request->valid == 'on') ? 1 : 0;
        $group->oid = Auth::user()->id;
        $group->save();

        return true;
    }

    /**
     * 新增群組
     *
     * @param Request $request
     * @return integer
     */
    public function insertGroup(Request $request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->functions = $request->functions;
        $group->users = $request->users;
        $group->valid = ($request->valid == 'on') ? 1 : 0;
        $group->oid = Auth::user()->id;
        $group->save();

        return $group->id;
    }

    /**
     * 移除群組
     *
     * @param integer $id
     * @return bool
     */
    public function deleteGroup($id = 0)
    {
        $group = $this->getGroup($id);
        $group->delete();

        return true;
    }

    /**
     * 依使用者ID取得群組
     *
     * @param integer $userId
     * @return void
     */
    public function getUserGroups($userId = 0)
    {
        $groups = Group::where('users', 'like', '%,' . $userId . ',%')->get();

        return $groups;
    }
}