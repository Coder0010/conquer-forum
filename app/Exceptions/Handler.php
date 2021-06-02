<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
        'new_password',
        'new_password_confirmation',

    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $throw
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $throw)
    {
        if (app()->bound("sentry") && $this->shouldReport($throw)) {
            app("sentry")->captureException($throw);
        }

        return parent::render($request, $throw);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $throw
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $throw)
    {
        if ($request->expectsJson()) {
            return response()->json([
                "payload" => [
                    "message" => __("main.session_unauthenticated")
                ],
            ], 422);
        }
        if ($request->segment(1) === config("system.admin.url_prefix")) {
            return redirect()->guest(config("system.admin.url_prefix")."/login");
        }else{
            return redirect()->guest("login");
        }
    }
}
