<?php

namespace App\Repository\Backend;

use App\PromoteForm;

class PromoteFormRepository
{
    public function search($username, $pageLimit)
    {
        $query = PromoteForm::select('*');

        if (!empty($username)) {
            $query->where('username', $username);
        }

        if ($pageLimit === 0) {
            $models = $query->get();
        } else {
            $models = $query->paginate($pageLimit);
        }

        return $models;
    }
}
