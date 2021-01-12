<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Backend\UserService;
use App\Repository\Backend\LineManagementRepository;
use Auth;

class LineManagementController extends Controller
{
    protected $lineManagementRepo;
    protected $userSv;

    public function __construct(LineManagementRepository $lineManagementRepository,
                                UserService $userService)
    {
        $this->lineManagementRepo = $lineManagementRepository;
        $this->userSv = $userService;
    }

    /**
     * 修改頁
     *
     */
    public function editPage()
    {
        $user_id = Auth::user()->id;
        $row = $this->lineManagementRepo->getByUserId($user_id);

        if (!is_null($row)) {
            $add_friend_link = $row->add_friend_link;
        } else {
            $add_friend_link = '';
        }

        return view('admin.line_management.edit', [
            'add_friend_link' => $add_friend_link,
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $user_id = Auth::user()->id;
        $line_link = $request->input('line_link');
        $this->lineManagementRepo->updateByUserId($user_id, $line_link);

        return redirect('/backend/line_management/edit/');
    }
}
