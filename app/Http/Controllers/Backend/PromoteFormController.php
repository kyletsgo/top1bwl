<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Services\Backend\PromoteFormService;
use App\Repository\Backend\UserRepository;
use App\Services\Backend\UserService;
use Auth;

class PromoteFormController extends Controller
{
    protected $siteManagementServ;
    protected $userSv;
    protected $userRepo;

    public function __construct(PromoteFormService $siteManagementService,
                                UserService $userService,
                                UserRepository $userRepository)
    {
        $this->siteManagementServ = $siteManagementService;
        $this->userSv = $userService;
        $this->userRepo = $userRepository;
    }

    /**
     * 列表頁
     *
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user = $this->userRepo->getById($user_id);

        if ($this->userSv->isAdminUser($user_id)) {
            $rows = $this->siteManagementServ->searchList('', 15);
        } else {
            $rows = $this->siteManagementServ->searchList($user->username, 15);
        }

        return view('admin.promote_form_manage.list', [
            'rows' => $rows,
        ]);
    }

}
