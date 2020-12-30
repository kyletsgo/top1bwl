<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BaseException;
use App\Exceptions\ApiException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RefreshToken extends BaseMiddleware
{
    /**
     *  Handle an incoming request.
     *  此流程可以參考 ：
     * vendor/tymon/jwt-auth/src/Providers/AbstractServiceProvider.php -> $middlewareAliases
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|mixed
     * @throws ApiException
     */
    public function handle($request, Closure $next)
    {
        try
        {
            // 檢查 request 是否有 token
            // 可以在 query string(token), header(authorization, prefix bearer), cookie(token)
            $this->checkForToken($request);

            // 檢查使用者登錄狀態
            if (!$this->auth->parseToken()->authenticate()) {
                throw new ApiException(ApiException::TOKEN_INVALID, [
                    BaseException::FIELD_INFO => 'User not found'
                ]);
            }

            return $next($request);
        }
        catch (TokenExpiredException $exception)
        {
            try
            {
                // Refresh an expired token.
                $token = $this->auth->refresh();

               // 使用一次性登錄以保證此次請求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);

                // 為了在 response 時取得新的 token
                auth('api')->setToken($token);

                // 前面還沒檢查完就丟 TokenExpiredException，再檢查一次
                if (!$this->auth->parseToken()->authenticate()) {
                    throw new ApiException(ApiException::TOKEN_INVALID, [
                        BaseException::FIELD_INFO => 'User not found'
                    ]);
                }

                // 在 response header 中設定新的 token
                // Authorization = Bearer <token>
                return $this->setAuthenticationHeader($next($request), $token);
            }
            catch (JWTException $exception)
            {
                report($exception);

                // token blacklist, JWT_REFRESH_TTL 過期,
                throw new ApiException(ApiException::TOKEN_INVALID, [
                    BaseException::FIELD_INFO => $exception->getMessage()
                ]);
            }
        }
        catch (UnauthorizedHttpException $exception)
        {
            // checkForToken failed
            oDebug(url()->full());
            report($exception);

            throw new ApiException(ApiException::TOKEN_INVALID, [
                BaseException::FIELD_INFO => $exception->getMessage()
            ]);
        }
        catch (JWTException $exception)
        {
            // parseToken failed

            report($exception);

            throw new ApiException(ApiException::TOKEN_INVALID, [
                BaseException::FIELD_INFO => $exception->getMessage()
            ]);
        }
    }
}