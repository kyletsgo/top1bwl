<?php

namespace App\Repository\Backend;

use App\ResourceArticleManagement;

class ResourceManagementRepository
{
    public function search($pageLimit)
    {
        $query = ResourceArticleManagement::select('top1bwl_article_management.*', 'users.nickname', 'users.id as user_id');
        $query->join('users', 'top1bwl_article_management.user_id', '=', 'users.id');

        $query->orderBy('article_id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        return $models;
    }

    public function insert($user_id, $title, $content)
    {
        $model = new ResourceArticleManagement;
        $model->user_id = $user_id;
        $model->title = $title;
        $model->content = $content;
        $model->save();
    }

    public function update($id, $title, $content)
    {
        $model = ResourceArticleManagement::find($id);
        $model->title = $title;
        $model->content = $content;
        $model->save();

        return $model->article_id;
    }

    public function getById($id)
    {
        $query = ResourceArticleManagement::select('top1bwl_article_management.*', 'users.id as user_id');
        $query->join('users', 'top1bwl_article_management.user_id', '=', 'users.id');
        return $query->find($id);
    }

    public function getFromUsers($user_ids)
    {
        $query = ResourceArticleManagement::select('top1bwl_article_management.*');
        if ($user_ids != null) {
            $query->whereIn('user_id', $user_ids);
        }
        $query->orderBy('article_id', 'asc');
        $models = $query->get();

        return $models;
    }

    public function delete($id)
    {
        $model = ResourceArticleManagement::find($id);
        $model->delete();
    }
}
