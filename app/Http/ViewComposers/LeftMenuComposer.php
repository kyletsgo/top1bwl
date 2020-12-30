<?php

namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repository as Repo;
use Auth;

class LeftMenuComposer {

    //User ID
    protected $userId;

    //User Name
    protected $userName;

    //Group Repository
    protected $groupRepo;

    //Functions Repository
    protected $functionRepo;

    public function __construct(Repo\Backend\GroupRepository $groupRepo, Repo\Backend\FunctionRepository $functionRepo)
    {
        if (Auth::check())
        {
            $user = Auth::user();
            $this->userId = $user->id;
            $this->userName = $user->name;
        }
        else
        {
            $this->userId = 1;
            $this->userName = "Guest";
        }

        $this->groupRepo = $groupRepo;
        $this->functionRepo = $functionRepo;
    }

    public function compose(View $view)
    {
        $view->with([
            'leftMenu' => $this->createLeftMenu(),
            'userName' => $this->userName
        ]);
    }

    protected function createLeftMenu()
    {
        $result = array();

        $userGroups = $this->groupRepo->getUserGroups($this->userId);

        $groupFunctions = '';

        foreach ($userGroups as $group)
        {
            $groupFunctions .= $group->functions;
        }

        $groupFunctions = array_filter(array_unique(explode(',', $groupFunctions)));
        $groupFunctions = $this->functionRepo->getFunctions($groupFunctions);

        $menus = array();

        foreach ($groupFunctions as $function)
        {
            array_push($menus, $function->menu);
        }

        $menus = array_unique($menus);

        $menusArray = '';

        foreach ($menus as $menu)
        {
            $appendData = [
                'name' => $menu->name,
                'icon' => $menu->icon,
                'functions' => $groupFunctions->where('menu_id', $menu->id)->toArray()
            ];

            array_push($result, $appendData);
        }

        return $result;
    }
}