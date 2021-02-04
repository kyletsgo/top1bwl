<?php

namespace App\Repository\Backend;

use App\PageManagement;
use App\SiteManagement;
use App\Template;
use App\PromoteForm;

class PageManagementRepository
{
    public function search($current_user, $pageLimit)
    {
        $query = PageManagement::select('top1bwl_page_management.*', 'top1bwl_site_management.folder_name'
            , 'users.nickname');
        $query->join('top1bwl_site_management', 'top1bwl_page_management.site_id', '=', 'top1bwl_site_management.site_id');
        $query->join('users', 'top1bwl_site_management.user_id', '=', 'users.id');

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

        $query->orderBy('page_id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        return $models;
    }

    public function insert($site_id, $title, $content)
    {
        $model = new PageManagement;
        $model->site_id = $site_id;
        $model->title = $title;
        $model->content = $content;
        $model->save();
    }

    public function update($page_id, $title, $content)
    {
        $model = PageManagement::find($page_id);
        $model->title = $title;
        $model->content = $content;
        $model->save();

        return $model->page_id;
    }

    public function delete($id)
    {
        $model = PageManagement::find($id);
        $model->delete();
    }

    public function getById($id)
    {
        return PageManagement::find($id);
    }

    public function getAllPagesByFolderName($folder_name)
    {
        return SiteManagement::select('top1bwl_page_management.page_id', 'top1bwl_page_management.title')
            ->join('top1bwl_page_management', 'top1bwl_site_management.site_id', '=', 'top1bwl_page_management.site_id')
            ->where('folder_name', $folder_name)
            ->get();
    }

    public function getTemplate($template_id)
    {
        return Template::find($template_id);
    }

    public function savePromoteForm($email, $name, $line, $username)
    {
        $model = new PromoteForm();
        $model->email = $email;
        $model->name = $name;
        $model->line = $line;
        $model->username = $username;
        $model->save();
    }

    public function getUserSiteBySiteId($site_id)
    {
        return SiteManagement::join('users', 'top1bwl_site_management.user_id', '=', 'users.id')
            ->where('site_id', $site_id)
            ->first();
    }

}
