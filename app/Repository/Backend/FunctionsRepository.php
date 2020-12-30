<?php
namespace App\Repository\Backend;

use App\Functions;
use Illuminate\Http\Request;

class FunctionsRepository
{
    public function __construct()
    {

    }

    /**
     * 取得所有使用者
     *
     * @return User
     */
    public function getAllUser()
    {
        return User::all();
    }

    /**
     * 取得單一使用者資料
     *
     * @param integer $id
     * @return User
     */
    public function getUser($id = 0)
    {
        return User::find($id);
    }

    /**
     * 更新使用者資料
     *
     * @param Request $request
     * @param integer $id
     * @return bool
     */
    public function modifyUser(Request $request, $id = 0)
    {
        $user = $this->getUser($id);
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();

        return true;
    }

    /**
     * 新增使用者
     *
     * @param Request $request
     * @return integer
     */
    public function insertUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $user->id;
    }

    /**
     * 移除使用者
     *
     * @param integer $id
     * @return bool
     */
    public function deleteUser($id = 0)
    {
        $user = $this->getUser($id);
        $user->delete();

        return true;
    }

    public function getFunctions($functionIds = array())
    {
        $result = Functions::whereIn('id', $functionIds)->get();

        return $result;
    }
}