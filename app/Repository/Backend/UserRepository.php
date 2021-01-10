<?php

namespace App\Repository\Backend;

use App\User;
use App\Group;

class UserRepository
{
    public function search($username, $pageLimit)
    {
//        \DB::enableQueryLog();

        $query = User::select('*');

        if (!empty($username)) {
            $query->where('username', $username);
        }

        $query->orderBy('id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

//        \Log::debug(\DB::getQueryLog());

        return $models;
    }

    public function insert($nickname, $username, $password)
    {
        $user = new User();
        $user->nickname = $nickname;
        $user->username = $username;
        $user->password = bcrypt($password);
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