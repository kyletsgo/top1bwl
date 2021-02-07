<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use App\Repository\Backend\CarouselManagementRepository;
use App\Presenter\MessagePresenter;
use Cookie;
use Auth;

class CarouselManagementService
{
    protected $promoManagementRepo;

    public function __construct(CarouselManagementRepository $promoManagementRepository)
    {
        $this->promoManagementRepo = $promoManagementRepository;
    }

    public function searchList(Request $request, $pageLimit = 0)
    {
        return $this->promoManagementRepo->search($pageLimit);
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

    public function createItem(Request $request)
    {
        $this->promoManagementRepo->insert($request->user_id, $request->carouselTitle, $request->images);
    }

    public function getEditItem($id)
    {
        return $this->promoManagementRepo->getById($id);
    }

    public function updateItem(Request $request)
    {
        $validateRules = [
            'title' => 'required|max:80',
        ];

        $validateMessage = [
            'title.required' => MessagePresenter::getRequired('標題'),
            'title.max' => MessagePresenter::getMax('標題', 80),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->promoManagementRepo->update($request->promo_id, $request->title, $request->image_url, $request->isDefault);
    }

    public function enableSite($site_id, $enable)
    {
        $this->promoManagementRepo->updateEnable($site_id, $enable);
    }

}