<?php

namespace App\Repository\Backend;

use App\CalendarManagement;

class CalendarManagementRepository
{
    public function getById($id)
    {
        return CalendarManagement::find($id);
    }

    public function update($calendar_id, $image_small, $image_large)
    {
        $model = CalendarManagement::find($calendar_id);
        if (!empty($image_small)) {
            $model->image_small = $image_small;
        }
        if (!empty($image_large)) {
            $model->image_large = $image_large;
        }
        $model->save();

        return $model->calendar_id;
    }

    public function getCalendar()
    {
        return CalendarManagement::find(1);
    }
}
