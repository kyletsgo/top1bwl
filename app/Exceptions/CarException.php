<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class CarException extends BaseException
{
    //throw new CarException(CarException::ORIGIN_CAR_404);
    const ORIGIN_CAR_404 = [1, 'CATCH DB車輛不存在'];
    // const MEMBER_CAR_404 = [2, '會員車輛資料不存在'];
    const MEMBER_CAR_EXCEED = [3, '會員車輛不可超過三輛'];
    const MEMBER_CAR_EXIST = [4, '車輛已被同帳號加入'];
    const ADD_CAR_ERROR = [5, '車輛加入失敗'];
    const GET_CAR_ERROR = [6, '取得車輛失敗'];
    const DELETE_CAR_ERROR = [7, '車輛刪除失敗'];
    const IMPORT_MAINTAIN_ERROR = [8, '匯入保養資料失敗'];
    const MEMBER_CAR_NAME_ERROR = [9, '車主姓名需相同'];
    const CAR_EXIST = [10, '車輛已被不同帳號綁定'];
    const UPDATE_CAR_ERROR = [11, '車輛更新失敗'];


    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if(isApiCall())
        {
            return response()->json([
                'Result' => 'N',
                'ErrorCode' => $this->getCode(),
                'ErrorMsg' => $this->getMessage(),
            ],200);
        }
        else 
        {
            return redirect()->back()->withErrors([json_decode($this->getMessage())]);
        }
    }
}