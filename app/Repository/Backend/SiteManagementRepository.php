<?php

namespace App\Repository\Backend;

use App\SiteManagement;

class SiteManagementRepository
{
    public function search($username, $folder_name, $enable, $user_id, $pageLimit)
    {
        \DB::enableQueryLog();

        $query = SiteManagement::select('top1bwl_site_management.*', 'users.nickname');
        $query->join('users', 'top1bwl_site_management.user_id', '=', 'users.id');

        if (!is_null($user_id)) {
            $query->where('user_id', $user_id);
        }

        if (!is_null($username)) {
            $query->where('username', 'like', '%'.$username.'%');
        }

        if (!is_null($folder_name)) {
            $query->where('folder_name', $folder_name);
        }

        if (!is_null($enable)) {
            $query->where('enable', $enable);
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
