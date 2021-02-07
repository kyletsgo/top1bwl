<?php

namespace App\Repository\Backend;

use App\CarouselManagement;

class CarouselManagementRepository
{
    public function search($pageLimit)
    {
        \DB::enableQueryLog();

        $query = CarouselManagement::select('*');

        $query->orderBy('promo_id', 'asc');

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        \Log::debug(\DB::getQueryLog());

        return $models;
    }

    public function insert($user_id, $carouselTitle, $images)
    {
        $model = new CarouselManagement;
        $model->user_id = $user_id;
        $model->title = $carouselTitle;
        $model->content = $images;
        $model->save();
    }

    public function update($promo_id, $title, $image_url, $isDefault)
    {
        $model = CarouselManagement::find($promo_id);
        $model->title = $title;

        if (!empty($image_url)) {
            $model->image_url = $image_url;
        }

        $model->isDefault = $isDefault;
        $model->save();

        return $model->promo_id;
    }

    public function getById($id)
    {
        return CarouselManagement::find($id);
    }

    public function getByUserId($user_id)
    {
        return CarouselManagement::where('user_id', $user_id)->get();
    }
}
