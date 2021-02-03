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

    public function showUserControl($current_user_role, $row)
    {
        $html = '';

        $a = '<a class="btn btn-success btn-xs" href="/backend/user/edit/'.$row->id.'">
                    <strong>修改密碼</strong>
                </a>';

        $b = '<button type="button" class="btn btn-danger btn-xs deleteUser" data-userid="'.$row->id.'">
                    <strong>刪除帳號</strong>
                </button>';

        $c = '<button type="button" class="btn btn-warning btn-xs releaseAuth" data-userid="'.$row->id.'">
                    <strong>下放權限</strong>
                </button>';

        switch ($current_user_role) {
            case 1: // 一般會員
                $html = $a;
                break;
            case 2: // 管理員
                if ($row->role === 1) {
                    $html = $a . $b . $c;
                } else if ($row->role === 2) {
                    $html = $a;
                } else if ($row->role === 3) {
                    $html = $a . $b;
                }
                break;
            case 3: // 代理管理員
                if ($row->role === 1) {
                    $html = $a . $b;
                } else if ($row->role === 3) {
                    $html = $a;
                }
                break;
        }

        return $html;
    }

    public function showSiteControl($current_user_role, $row)
    {
        $html = '';

        $a = '<a class="btn btn-warning btn-xs" href="/backend/site_management/edit/'.$row->site_id.'">
                    <strong>編輯</strong>
                </a>';

        $b = '<a class="btn btn-info btn-xs" href="/backend/page_manage/">
                    <strong>前往建立網頁</strong>
                </a>';

        $c = '<button type="button" class="btn btn-success btn-xs enableSite" data-siteid="'.$row->site_id.'">
                    <strong>生成網站</strong>
                </button>';

        switch ($current_user_role) {
            case 1: // 一般會員
                $html = $a;
                break;
            case 2: // 管理員
                $html = $a;
                if ($row->enable === 1) {
                    $html .= $b;
                } else {
                    $html .= $c;
                }
                break;
            case 3: // 代理管理員
                if ($row->role === 1) {
                    if ($row->enable === 1) {
                        $html .= $b;
                    } else {
                        $html .= $c;
                    }
                } else if ($row->role === 3) {
                    if ($row->enable === 1) {
                        $html .= $b;
                    }
                }
                break;
        }

        return $html;
    }
}