<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResourceManageController extends Controller
{
    public function __construct()
    {
    }

    /**
     * 修改頁
     *
     */
    public function edit()
    {
        return view('admin.resource.edit',[
        ]);
    }
}
