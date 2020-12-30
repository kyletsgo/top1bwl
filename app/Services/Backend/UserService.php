<?php

namespace App\Services\Backend;

use Illuminate\Http\Request;
use App\Repository\Backend\UserRepository;
use App\Presenter\MessagePresenter;
use Cookie;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    public function searchList(Request $request, $pageLimit = 0)
    {
        return $this->userRepo->search($pageLimit);
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
        $validateRules = [
            'nickname' => 'max:100',
            'username' => 'required|max:100|unique:users',
            'password' => 'required|max:60',
        ];

        $validateMessage = [
            'nickname.required' => MessagePresenter::getRequired('名稱'),
            'nickname.max' => MessagePresenter::getMax('名稱', 100),
            'username.required' => MessagePresenter::getRequired('帳號'),
            'username.max' => MessagePresenter::getMax('帳號', 100),
            'username.unique' => MessagePresenter::getUnique('帳號'),
            'password.required' => MessagePresenter::getRequired('密碼'),
            'password.max' => MessagePresenter::getMax('密碼','60'),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->userRepo->insert($request->nickname, $request->username, $request->password);
    }

    public function getEditItem($id)
    {
        return $this->userRepo->getById($id);
    }

    public function updateItem(Request $request, $id)
    {
        $validateRules = [
            'nickname' => 'max:100',
            'password' => 'max:60',
        ];

        $validateMessage = [
            'nickname.required' => MessagePresenter::getRequired('名稱'),
            'nickname.max' => MessagePresenter::getMax('名稱', 100),
            'password.max' => MessagePresenter::getMax('密碼','60'),
        ];

        $request->validate($validateRules, $validateMessage);

        return $this->userRepo->update($id, $request->nickname, $request->password);
    }

    public function deleteItem($id)
    {
        $this->userRepo->delete($id);
    }

    public function releaseAuthForUserId($userId)
    {
        $user = $this->userRepo->getById($userId);
        $current_group = $this->userRepo->getGroup($user->role);

        // 移除 $current_group.users
        $this->userRepo->updateGroupUsers($current_group, $this->removeUser($current_group->users, $user->id));

        // 加入 userId 到 group.id = 3
        $agent_admin_group = $this->userRepo->getGroup(3);
        $agent_admin_users = $agent_admin_group->users;
        $agent_admin_users = trim($agent_admin_users, ',');
        if (!empty($agent_admin_users)) {
            $agent_admin_users_array = explode(',', $agent_admin_users);
            $agent_admin_users_array[] = $user->id;
            $new_agent_admin_users = implode(',', $agent_admin_users_array);
        } else {
            $new_agent_admin_users = $user->id;
        }
        $new_agent_admin_users = ',' . $new_agent_admin_users . ',';
        $this->userRepo->updateGroupUsers($agent_admin_group, $this->addUser($agent_admin_group->users, $user->id));

        // 更新 $user.role
        $this->userRepo->updateUserRole($user, 3);
    }

    private function removeUser($users, $userId)
    {
        $users = trim($users, ',');
        $users_array = explode(',', $users);
        if (($key = array_search($userId, $users_array)) !== false) {
            unset($users_array[$key]);
        }
        $new_users = implode(',', $users_array);
        if (!empty($new_users)) {
            $new_users = ',' . $new_users . ',';
        }

        return $new_users;
    }

    public function addUserToGroup($userId, $groupId)
    {
        $group = $this->userRepo->getGroup($groupId);
        $this->userRepo->updateGroupUsers($group, $this->addUser($group->users, $userId));
    }

    private function addUser($users, $userId)
    {
        $users = trim($users, ',');
        if (!empty($users)) {
            $users_array = explode(',', $users);
            $users_array[] = $userId;
            $new_users = implode(',', $users_array);
        } else {
            $new_users = $userId;
        }
        $new_users = ',' . $new_users . ',';

        return $new_users;
    }

    public function isAdminUser($userId)
    {
        $user = $this->userRepo->getById($userId);

        if ($user->role === 2 || $user->role === 3) {
            return true;
        }

        return false;
    }
}