<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Repository\Backend\CalendarManagementRepository;

class CalendarController extends Controller
{
    protected $calendarManagementRepo;

    public function __construct(CalendarManagementRepository $calendarManagementRepository)
    {
        $this->calendarManagementRepo = $calendarManagementRepository;
    }

    public function show()
    {
        $row = $this->calendarManagementRepo->getById(1);

        return view('admin.calendar.show', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $image_large = '';
        if ($request->hasFile('largeImage')) {
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
