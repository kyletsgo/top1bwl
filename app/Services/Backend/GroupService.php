<?php
namespace App\Services\Backend;

use App\Repository as Repo;
use Illuminate\Http\Request;
use App\Presenter\MessagePresenter;

class GroupService
{
    //Group Repository
    protected $group;

    /**
     * 建構子
     *
     * @param Repo\Backend\GroupRepository $group
     */
    public function __construct(Repo\Backend\GroupRepository $group)
    {
        $this->group = $group;
    }

    /**
     * 取得所有群組
     *
     * @return void
     */
    public function getAllGroups()
    {
        return $this->group->getAllGroups();
    }

    /**
     * 取得群組
     *
     * @param integer $id
     * @return void
     */
    public function getGroup($id = 0)
    {
        return $this->group->getGroup($id);   
    }

    /**
     * 新增群組
     *
     * @param Request $request
     * @return void
     */
    public function insertGroup(Request $request)
    {
        $validateRules = [
            'name' => 'required|max:100',
            'functions' => 'required',
            'users' => 'required',
            'valid' => 'required',
        ];

        $validateMessage = [
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 100),
            'functions.required' => MessagePresenter::getRequired('功能'),
            'users.required' => MessagePresenter::getRequired('使用者'),
            'valid.required' => MessagePresenter::getRequired('有效否'),          
        ];

        $request->validate($validateRules, $validateMessage);

        $groupId = $this->group->insertGroup($request);

        return $groupId;
    }

    /**
     * 修改群組
     *
     * @param Request $request
     * @param integer $groupId
     * @return void
     */
    public function modifyGroup(Request $request, $groupId = 0)
    {
        $validateRules = [
            'name' => 'required|max:100',
            'functions' => 'required',
            'users' => 'required',
            'valid' => 'required',
        ];

        $validateMessage = [
            'name.required' => MessagePresenter::getRequired('名稱'),
            'name.max' => MessagePresenter::getMax('名稱', 100),
            'functions.required' => MessagePresenter::getRequired('功能'),
            'users.required' => MessagePresenter::getRequired('使用者'),
            'valid.required' => MessagePresenter::getRequired('有效否'),           
        ];

        $request->validate($validateRules, $validateMessage);

        $isSuccessful = $this->group->modifyGroup($request, $groupId);

        return $isSuccessful;
    }

    /**
     * 刪除群組
     *
     * @param integer $groupId
     * @return void
     */
    public function deleteGroup($groupId = 0)
    {
        $isSuccessful = $this->group->deleteGroup($groupId);

        return $isSuccessful;
    }
}