<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    protected $groupService, $functionService, $userService;

    /**
     * 建構子
     *
     * @param \App\Services\Backend\GroupService $groupService
     * @param \App\Services\Backend\FunctionService $functionService
     * @param \App\Services\Backend\UserService $userService
     */
    public function __construct(\App\Services\Backend\GroupService $groupService,
                                \App\Services\Backend\FunctionService $functionService,
                                \App\Services\Backend\UserService $userService)
    {
        $this->groupService = $groupService;
        $this->userService = $userService;
        $this->functionService = $functionService;
    }

    /**
     * 列表
     *
     * @return void
     */
    public function index()
    {
        $groups = $this->groupService->getAllGroups();

        $viewData = [
            'groups' => $groups,
        ];

        return view('admin.group.list', $viewData);
    }

    /**
     * 建立
     *
     * @return void
     */
    public function create()
    {
        $unassignedUsers = $this->userService->getGroupUsers(null, false);
        $unassignedFunctions = $this->functionService->getGroupFunctions(null, false);

        $viewData = [
            'unassignedUsers' => $unassignedUsers,
            'unassignedFunctions' => $unassignedFunctions
        ];

        return view('admin.group.create', $viewData);
    }

    /**
     * 編輯
     *
     * @param integer $id
     * @return void
     */
    public function edit($id = 0)
    {
        $group = $this->groupService->getGroup($id);
        $assignedUsers = $this->userService->getGroupUsers($group->users, true);
        $unassignedUsers = $this->userService->getGroupUsers($group->users, false);
        $assignedFunctions = $this->functionService->getGroupFunctions($group->functions, true);
        $unassignedFunctions = $this->functionService->getGroupFunctions($group->functions, false);

        $viewData = [
            'group' => $group,
            'assignedUsers' => $assignedUsers,
            'unassignedUsers' => $unassignedUsers,
            'assignedFunctions' => $assignedFunctions,
            'unassignedFunctions' => $unassignedFunctions
        ];

        return view('admin.group.edit', $viewData);
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->groupService->modifyGroup($request, $id);

        return redirect('/backend/group/' . $id);
    }

    /**
     * 儲存
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $groupId = $this->groupService->insertGroup($request);

        return redirect('/backend/group/' . $groupId);
    }

    /**
     * 刪除
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $this->groupService->deleteGroup($id);

        return redirect()->back();
    }
}
