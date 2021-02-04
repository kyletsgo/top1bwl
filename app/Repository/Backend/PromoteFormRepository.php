<?php

namespace App\Repository\Backend;

use App\PromoteForm;

class PromoteFormRepository
{
    public function search($current_user, $pageLimit)
    {
        $query = PromoteForm::select('*');
        $query->join('users', 'top1bwl_promote_form.username', '=', 'users.username');

        // 一般會員顯示 自己的
        if ($current_user->role === 1) {
            $query->where('users.id', $current_user->id);
        }

        // 代理管理員顯示 自己+自己所生成的一般會員
        if ($current_user->role === 3) {
            $query->where(function($q) use ($current_user) {
                $q->where('users.id', $current_user->id)
                    ->orWhere('users.parent_user_id', $current_user->id);
            });
        }

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        return $models;
    }
}
