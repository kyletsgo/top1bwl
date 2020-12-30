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
}