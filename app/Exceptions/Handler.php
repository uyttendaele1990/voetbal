<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;
use Illuminate\Auth\AuthenticationException;
use Response;

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
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    // deze functie verplaatsts van Illuminate\Foundation\Exceptions\handler zodat dit niet overschreven word als we composer updaten
    // dit zorgt ervoor dat je word geredirect naar de correcte login pagina als je een pagina wilt zien die beveiligd is en je bent nog niet ingelogd
     protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()){
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = array_get($exception->guards(),0);
        // admin side
        switch ($guard) {
            case 'admin':
                return redirect()->guest(route('admin.login'));
                break;
        // user side
            default:
                return redirect()->guest(route('login'));
                break;
        }
        
    }
}
