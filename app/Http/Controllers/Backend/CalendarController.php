<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Auth;

class CalendarController extends Controller
{
    public function __construct()
    {
    }

    public function show()
    {
        return view('admin.calendar.show', [
        ]);
    }

}
