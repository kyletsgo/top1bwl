<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use App\Repository\Backend\ResourceManagementRepository;
use App\Presenter\MessagePresenter;
use Cookie;
use Auth;

class ResourceManagementService
{
    protected $resourceManagementRepo;

    public function __construct(ResourceManagementRepository $resourceManagementRepository)
    {
        $this->resourceManagementRepo = $resourceManagementRepository;
    }

    public function searchList($pageLimit = 0)
    {
        return $this->resourceManagementRepo->search($pageLimit);
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

    public function createItem(Request $request, $user_id)
    {
        $validateRules = [
            'title' => 'required|max:80',
            'content' => 'required|max:60000',
        ];

        $validateMessage = [
            'title.required' => MessagePresenter::getRequired('標題'),
            'title.max' => MessagePresenter::getMax('標題', 80),
            'content.required' => MessagePresenter::getRequired('內容'),
            'content.max' => MessagePresenter::getMax('內容', 60000),
        ];

        $request->validate($validateRules, $validateMessage);

        $this->resourceManagementRepo->insert($user_id, $request->title, $request->input('content'));
    }

    public function getEditItem($id)
    {
        return $this->resourceManagementRepo->getById($id);
    }

    public function updateItem(Request $request, $id)
    {
        $validateRules = [
            'title' => 'required|max:80',
            'content' => 'required|max:60000',
        ];

        $validateMessage = [
            'title.required' => MessagePresenter::getRequired('標題'),
            'title.max' => MessagePresenter::getMax('標題', 80),
            'content.required' => MessagePresenter::getRequired('內容'),
            'content.max' => MessagePresenter::getMax('內容', 60000),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->resourceManagementRepo->update($id, $request->title, $request->input('content'));
    }

}