<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class LoginException extends BaseException
{
    const VALIDATE_FAIL_C_HASH = [1, '驗證錯誤 - c_hash'];
    const VALIDATE_FAIL_ID_TOKEN_CLAIMS = [2, '驗證錯誤 - id_token claims'];
    const VALIDATE_FAIL_ID_TOKEN_SIGNATURE = [3, '驗證錯誤 - id_token signature'];
    const VALIDATE_FAIL_REFRESH_TOKEN = [4, '驗證錯誤 - refresh_token'];
    const REFRESH_TOKENS_FAILED = [5, 'refresh tokens failed'];
    const ADD_CHATBOT_FAILED = [6, '新增Chatbot會員紀錄失敗'];

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
            'UserToken' => '',
            'UserData' => '',
        ],200);
    }
}