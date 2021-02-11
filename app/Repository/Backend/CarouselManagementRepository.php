<?php

namespace App\Repository\Backend;

use App\CarouselManagement;

class CarouselManagementRepository
{
    public function search($current_user, $pageLimit)
    {
        \DB::enableQueryLog();

        $query = CarouselManagement::select('*');
        $query->where('user_id', $current_user->id);

        $query->orderBy('carousel_id', 'asc');

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

    public function update($carousel_id, $carouselTitle, $images)
    {
        $model = CarouselManagement::find($carousel_id);
        $model->title = $carouselTitle;
        $model->content = $images;
        $model->save();

        return $model->carousel_id;
    }

    public function getById($id)
    {
        return CarouselManagement::find($id);
    }

    public function getByUserId($user_id)
    {
        return CarouselManagement::where('user_id', $user_id)->get();
    }

    public function delete($id)
    {
        $model = CarouselManagement::find($id);
        $model->delete();
    }
}
