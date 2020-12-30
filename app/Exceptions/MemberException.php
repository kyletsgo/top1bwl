<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class MemberException extends BaseException
{
    const GET_QRCODE_FAIL = [1, '產生 QR Code 錯誤'];
    const GET_MEMBER_LEVEL_INFO_FAIL = [2, '取得會員等級資訊錯誤'];

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