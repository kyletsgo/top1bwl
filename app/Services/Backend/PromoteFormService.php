<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use Cookie;
use Auth;
use App\Repository\Backend\PromoteFormRepository;

class PromoteFormService
{
    protected $siteManagementRepo;

    public function __construct(PromoteFormRepository $siteManagementRepository)
    {
        $this->siteManagementRepo = $siteManagementRepository;
    }

    public function searchList($current_user, $pageLimit = 0)
    {
        return $this->siteManagementRepo->search($current_user, $pageLimit);
    }
}