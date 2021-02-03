<?php

namespace App\Repository\Backend;

use App\User;
use App\Group;
use DB;

class UserRepository
{
    public function search($current_user, $request, $pageLimit)
    {
//        DB::enableQueryLog();

        $query = DB::table('users as u1')->select('u1.*', 'u2.username as parent_username')
            ->leftJoin('users AS u2', 'u1.parent_user_id', '=', 'u2.id');

        // 一般會員顯示 自己的
        if ($current_user->role === 1) {
            $query->where('u1.id', $current_user->id);
        }

        // 代理管理員顯示 自己+自己所生成的一般會員
        if ($current_user->role === 3) {
            $query->where(function($q) use ($current_user) {
                $q->where('u1.id', $current_user->id)
                    ->orWhere('u1.parent_user_id', $current_user->id);
            });
        }

        $query->orderBy('u1.id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

//        \Log::debug(DB::getQueryLog());

        return $models;
    }

    public function insert($nickname, $username, $password, $parent_user_id)
    {
        $user = new User();
        $user->nickname = $nickname;
        $user->username = $username;
        $user->password = bcrypt($password);
        $user->parent_user_id = $parent_user_id;
        $user->save();

        return $user;
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function update($id, $nickname, $password)
    {
        $model = User::find($id);
        $model->nickname = $nickname;
        if (!empty($password)) {
            $model->password = bcrypt($password);
        }
        $model->save();

        return $model->id;
    }

    public function delete($id)
    {
        $model = User::find($id);
        $model->delete();
    }

    public function getGroup($id)
    {
        return Group::find($id);
    }

    public function updateGroupUsers($group, $users)
    {
        $group->users = $users;
        $group->save();
    }

    public function updateUserRole($user, $role)
    {
        $user->role = $role;
        $user->save();
    }
}