<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Backend\UserRepository;
use App\Presenter\BackendPresenter;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = (new UserRepository())->getById($user_id);
        $user_role = (new BackendPresenter())->convertUserRole($user->role);

        return view('admin.index', [
            'user_name' => $user->username,
            'user_role' => $user_role,
        ]);
    }
}
