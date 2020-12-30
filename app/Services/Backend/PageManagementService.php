<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use Cookie;
use Auth;
use App\Repository\Backend\PageManagementRepository;
use App\Presenter\MessagePresenter;

class PageManagementService
{
    protected $pageManagementRepo;

    public function __construct(PageManagementRepository $siteManagementRepository)
    {
        $this->pageManagementRepo = $siteManagementRepository;
    }

    public function searchList($site_id, $pageLimit)
    {
        return $this->pageManagementRepo->search($site_id, $pageLimit);
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

    public function createItem(Request $request, $site_id)
    {
        $this->pageManagementRepo->insert($site_id, $request->input('title'), $request->input('content'));
    }

    public function getEditItem($id)
    {
        return $this->pageManagementRepo->getById($id);
    }

    public function updateItem(Request $request)
    {
        $validateRules = [
            'title' => 'required',
            'content' => 'required',
        ];

        $validateMessage = [
            'title.required' => MessagePresenter::getRequired('標題','text'),
            'content.required' => MessagePresenter::getRequired('內容','text'),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->pageManagementRepo->update($request->page_id, $request->input('title'), $request->input('content'));
    }

}