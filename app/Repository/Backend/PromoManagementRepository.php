<?php

namespace App\Repository\Backend;

use App\PromoManagement;

class PromoManagementRepository
{
    public function search($pageLimit)
    {
        \DB::enableQueryLog();

        $query = PromoManagement::select('*');

        $query->orderBy('promo_id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        \Log::debug(\DB::getQueryLog());

        return $models;
    }

    public function insert($user_id, $title, $image_url)
    {
        $model = new PromoManagement;
        $model->user_id = $user_id;
        $model->title = $title;
        $model->image = $image_url;
        $model->save();
    }

    public function update($promo_id, $title, $image_url)
    {
        $model = PromoManagement::find($promo_id);
        $model->title = $title;

        if (!empty($image_url)) {
            $model->image = $image_url;
        }

        $model->save();

        return $model->promo_id;
    }

    public function getById($id)
    {
        return PromoManagement::find($id);
    }

    public function getAllPromo()
    {
        return PromoManagement::all();
    }
}
