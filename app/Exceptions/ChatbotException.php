<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/8/14
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class ChatbotException extends BaseException
{
    const AUTHORIZATION_VERIFY_FAIL = [1, 'Authorization 驗證錯誤'];

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