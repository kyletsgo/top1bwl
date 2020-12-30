<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\User;
use App\FunMenu;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

class PasswordController extends Controller
{
    public function index()
    {
        return view('admin.password');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'qpwd1' => 'required|max:255',
        ]);

        $user = User::find($request->user()->id);
        $user->password = bcrypt($request->qpwd1);
        $user->save();

        Session::flash('msg', 'Update Success!');

        return Redirect::back();
    }
}
