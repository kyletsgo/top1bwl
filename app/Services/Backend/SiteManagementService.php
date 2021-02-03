<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use App\Repository\Backend\SiteManagementRepository;
use App\Presenter\MessagePresenter;
use Cookie;
use Auth;

class SiteManagementService
{
    protected $redeemTaskRepo;

    public function __construct(SiteManagementRepository $siteManagementRepository)
    {
        $this->siteManagementRepo = $siteManagementRepository;
    }

    public function searchList($current_user, Request $request, $pageLimit = 0)
    {
        $request->username = $this->setCookie($request->username, 'b_sitemanagement_username');
        $request->folder_name = $this->setCookie($request->folder_name, 'b_sitemanagement_folder_name');
        $request->enable = $this->setCookie($request->enable, 'b_sitemanagement_enable');

        return $this->siteManagementRepo->search($current_user, $request->username, $request->folder_name, $request->enable, $pageLimit);
    }

    private function setCookie($input, $cookie)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $input = Cookie::get($cookie) ? Cookie::get($cookie) : null;
        } else {
            Cookie::queue($cookie, $input, 60);
        }

        return $input;
    }

    public function createItem($user)
    {
        $this->siteManagementRepo->insert($user);
    }

    public function getEditItem($id)
    {
        return $this->siteManagementRepo->getById($id);
    }

    public function updateItem(Request $request)
    {
        $validateRules = [
            'folder_name' => 'required|max:80',
            'site_name' => 'max:200',
        ];

        $validateMessage = [
            'folder_name.required' => MessagePresenter::getRequired('目錄名稱','text'),
            'folder_name.max' => MessagePresenter::getMax('目錄名稱', 80),
            'site_name.required' => MessagePresenter::getRequired('站名','text'),
            'site_name.max' => MessagePresenter::getMax('站名', 80),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->siteManagementRepo->update($request->site_id, $request->folder_name, $request->site_name, $request->title, $request->description, $request->og_meta);
    }

    public function enableSite($site_id, $enable)
    {
        $this->siteManagementRepo->updateEnable($site_id, $enable);
    }

}