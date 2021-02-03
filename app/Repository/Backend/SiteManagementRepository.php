<?php

namespace App\Repository\Backend;

use App\SiteManagement;

class SiteManagementRepository
{
    public function search($current_user, $username, $folder_name, $enable, $pageLimit)
    {
        \DB::enableQueryLog();

        $query = SiteManagement::select('top1bwl_site_management.*',
            'users.id as user_id', 'users.nickname', 'users.role', 'users.parent_user_id');
        $query->join('users', 'top1bwl_site_management.user_id', '=', 'users.id');

        if (!is_null($username)) {
            $query->where('users.username', 'like', '%'.$username.'%');
        }

        if (!is_null($folder_name)) {
            $query->where('folder_name', $folder_name);
        }

        if (!is_null($enable)) {
            $query->where('enable', $enable);
        }

        // 一般會員顯示 自己的
        if ($current_user->role === 1) {
            $query->where('top1bwl_site_management.user_id', $current_user->id);
        }

        // 代理管理員顯示 自己+自己所生成的一般會員
        if ($current_user->role === 3) {
            $query->where(function($q) use ($current_user) {
                $q->where('top1bwl_site_management.user_id', $current_user->id)
                    ->orWhere('users.parent_user_id', $current_user->id);
            });
        }

        $query->orderBy('site_id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        \Log::debug(\DB::getQueryLog());

        return $models;
    }

    public function insert($user)
    {
        $model = new SiteManagement;
        $model->user_id = $user->id;
        $model->folder_name = $user->username;
        $model->save();
    }

    public function update($site_id, $folder_name, $site_name, $title, $description, $og_meta)
    {
        $model = SiteManagement::find($site_id);
        $model->folder_name = $folder_name;
        $model->site_name = $site_name;
        $model->title = $title;
        $model->description = $description;
        $model->og_meta = $og_meta;
        $model->save();

        return $model->site_id;
    }

    public function getById($id)
    {
        return SiteManagement::find($id);
    }

    public function getByUserId($user_id)
    {
        return SiteManagement::where('user_id', $user_id)->first();
    }

    public function getBySiteId($site_id)
    {
        return SiteManagement::find($site_id);
    }

    public function updateEnable($site_id, $enable)
    {
        $model = SiteManagement::find($site_id);
        $model->enable = $enable;
        $model->save();
    }

}
