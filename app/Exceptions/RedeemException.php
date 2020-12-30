<?php
/**
 * Created by PhpStorm.
 * User: KyleCW.Lin
 * Date: 2019/1/23
 * Time: 上午 11:27
 */

namespace App\Exceptions;


class RedeemException extends BaseException
{
    const NOT_FOUND_REDEEM_ID = [1, '無此 RedeemID'];
    const VALIDATE_FAIL_REDEEM_ID = [2, '不屬於此會員的 RedeemID'];
    const VALIDATE_FAIL_REDEEM_CHECK = [3, '兌換檢查：當前狀態非已得點'];
    const VALIDATE_FAIL_RECEIVE_CHECK = [4, '領取檢查：當前狀態非已兌換'];
    const VALIDATE_FAIL_COPIED_CHECK = [5, '複製檢查：當前狀態非已領取'];
    const VALIDATE_FAIL_REDEEM_EXPIRED = [6, '已超過兌換期限'];
    const VALIDATE_FAIL_RECEIVE_EXPIRED = [7, '已超過領取期限'];
    const VALIDATE_FAIL_EXCEED_POINT_LIMIT = [8, '超過可領總點數上限'];

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
            'ErrorMsg' => $this->getMessage()
        ],200);
    }
}