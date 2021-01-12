<?php

namespace App\Repository\Backend;

use App\LineManagement;
use App\SiteManagement;

class LineManagementRepository
{
    public function getByUserId($user_id)
    {
        return LineManagement::where('user_id', $user_id)->first();
    }

    public function updateByUserId($user_id, $line_link)
    {
        LineManagement::updateOrCreate(
            ['user_id' => $user_id],
            [
                'add_friend_link' => $line_link,
            ]
        );
    }

    public function getLineLinkBySiteId($site_id)
    {
        $model = SiteManagement::select('top1bwl_line_management.add_friend_link')
            ->join('top1bwl_line_management', 'top1bwl_line_management.user_id', '=', 'top1bwl_line_management.user_id')
            ->where('site_id', $site_id)
            ->first();

        if (is_null($model)) {
            $add_friend_link = '';
        } else {
            $add_friend_link = $model->add_friend_link;
        }

        return $add_friend_link;
    }
}
