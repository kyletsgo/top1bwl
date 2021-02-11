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
        return $this->promoManagementRepo->search($request->current_user, $pageLimit);
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
        return $this->promoManagementRepo->update($request->carousel_id, $request->carouselTitle, $request->images);
    }

    public function deleteItem($id)
    {
        $this->promoManagementRepo->delete($id);
    }

}