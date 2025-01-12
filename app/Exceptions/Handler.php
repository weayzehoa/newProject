<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ApiResponser;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        //判斷 domain 是否為 api domain
        if(request()->getHost() == env('API_DOMAIN')){
            $this->renderable(function (Throwable $e) {
                return $this->handleException($e);
            });
        }
    }

    public function handleException(Throwable $e){
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->appCodeResponse('Error', 999, 'The specified method for the request is invalid', 405);
        }
        if ($e instanceof NotFoundHttpException) {
            return $this->appCodeResponse('Error', 999, 'The specified URL could not be found.', 404);
        }
        if ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }
        return $this->appCodeResponse('Error', 999, $e->getMessage(), $e->getStatusCode());
        // if($e->getStatusCode() == 404){
        //     return $this->appCodeResponse('Error', 999, 'The specified URL could not be found.', 404);
        // }elseif($e->getStatusCode() == 405){
        //     return $this->appCodeResponse('Error', 999, 'Method is not supported.', 405);
        // }else{
        //     if(env('APP_ENV') == 'local'){
        //         return $this->appCodeResponse('Error', 999, [$e->getMessage(), $e->getStatusCode()], 500);
        //     }else{
        //         return $this->appCodeResponse('Error', 999, 'Unexpected Exception. Try later', 500);
        //     }
        // }
    }

}
