<?php

namespace App\Repository\Backend;

use App\ResourceArticleManagement;

class ResourceManagementRepository
{
    public function search($pageLimit)
    {
        $query = ResourceArticleManagement::select('top1bwl_article_management.*');

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
        return ResourceArticleManagement::find($id);
    }
}
