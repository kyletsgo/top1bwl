<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class ApiException extends BaseException
{
    const TOKEN_INVALID = [1, 'Token 失效'];
    const VALIDATE_FAIL = [2, '參數驗證錯誤'];
    const SERVER_ERROR = [3, '系統錯誤'];

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'Result' => 'N',
            'ErrorCode' => $this->getCode(),
            'ErrorMsg' => $this->getMessage(),
        ],200);
    }
}