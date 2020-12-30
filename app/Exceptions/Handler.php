<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
//        $this->customReport($exception);

        parent::report($exception);
    }

    /**
     *  Render an exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws ApiException
     */
    public function render($request, Exception $exception)
    {
        if (isApiCall() && !ExceptionCode::isClassExist(get_class($exception))) {
            throw new ApiException(ApiException::SERVER_ERROR, [
                BaseException::FIELD_INFO => $exception->getMessage()
            ]);
        }

        return parent::render($request, $exception);
    }

    private function customReport(Exception $e)
    {
        $trace = '[0] '. str_after($e->getFile(), '\VolkswagenCRM\\') . '(' . $e->getLine() . ')' . ' -> ' . get_class($e) . '(' . $e->getCode() . ')' ."\n";;
        $count = (count($e->getTrace()) > 3) ? 3 : count($e->getTrace());

        for ($n=0; $n<$count; $n++) {
            $file = $e->getTrace()[$n]['file'] ?? '';
            $line = $e->getTrace()[$n]['line'] ?? '';
            $function = $e->getTrace()[$n]['function'] ?? '';

            $trace .= '[' . ($n+1) . '] '. str_after($file, '\VolkswagenCRM\\') . '(' . $line . ')' . ' -> ' . $function ."\n";
        }

        Log::error($e->getMessage(). "\n" . $trace);
    }
}
