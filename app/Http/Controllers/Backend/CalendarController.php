<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repository\Backend\UserRepository;
use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Repository\Backend\CalendarManagementRepository;

class CalendarController extends Controller
{
    protected $calendarManagementRepo;
    protected $userRepo;

    public function __construct(CalendarManagementRepository $calendarManagementRepository,
                                UserRepository $userRepository)
    {
        $this->calendarManagementRepo = $calendarManagementRepository;
        $this->userRepo = $userRepository;
    }

    public function show()
    {
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);

        $row = $this->calendarManagementRepo->getById(1);

        return view('admin.calendar.show', [
            'row' => $row,
            'current_user_role' => $current_user->role,
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $image_large = '';
        if ($request->hasFile('largeImage')) {
            \Log::debug('okokok');
            $orig_image_name = 'calendar-largeImage-' . time() . '.jpg';
            $image_path = $request->largeImage->storeAs('calendar', $orig_image_name, 'public');
            $image_large = Storage::url($image_path);
        }

        $image_small = '';
        if ($request->hasFile('smallImage')) {
            $orig_image_name = 'calendar-smallImage-' . time() . '.jpg';
            $image_path = $request->smallImage->storeAs('calendar', $orig_image_name, 'public');
            $image_small = Storage::url($image_path);
        }

        $this->calendarManagementRepo->update(1, $image_small, $image_large);

        return redirect('/backend/calendar/');
    }

}
