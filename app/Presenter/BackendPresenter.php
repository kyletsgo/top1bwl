<?php
namespace App\Presenter;

class BackendPresenter
{
    public function __construct()
    {
    }

    public function convertUserRole($value)
    {
        $text = '';

        switch ($value) {
            case 1:
                $text = '一般會員';
                break;
            case 2:
                $text = '管理員';
                break;
            case 3:
                $text = '代理管理員';
                break;
        }

        return $text;
    }

    public function showUserControl($user_role, $row_role, $row_id)
    {
        $html = '';

        $a = '<a class="btn btn-success btn-xs" href="/backend/user/edit/'.$row_id.'">
                    <strong>修改密碼</strong>
                </a>';

        $b = '<button type="button" class="btn btn-danger btn-xs deleteUser" data-userid="'.$row_id.'">
                    <strong>刪除帳號</strong>
                </button>';

        $c = '<button type="button" class="btn btn-warning btn-xs releaseAuth" data-userid="'.$row_id.'">
                    <strong>下放權限</strong>
                </button>';

        switch ($user_role) {
            case 1: // 一般會員
                $html = $a;
                break;
            case 2: // 管理員
                if ($row_role === 1) {
                    $html = $a . $b . $c;
                } else if ($row_role === 2) {
                    $html = $a;
                } else if ($row_role === 3) {
                    $html = $a . $b;
                }
                break;
            case 3: // 代理管理員
                if ($row_role === 1) {
                    $html = $a . $b;
                } else if ($row_role === 3) {
                    $html = $a;
                }
                break;
        }

        return $html;
    }
}