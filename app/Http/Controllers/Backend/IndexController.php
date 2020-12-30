<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Backend\UserRepository;
use Auth;

class IndexController extends Controller
{
    public function index()
    {
        $userRepo = new UserRepository();

        $user_id = Auth::user()->id;
        $user = $userRepo->getById($user_id);

        return view('admin.index', [
            'user_name' => $user->username
        ]);
    }
}
