<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;



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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
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
    public function render($request, Throwable $exception)
    {
        // if (!$request->is('admin/*') && $exception instanceof NotFoundHttpException) {

        //     return response()->view('front');
        // }

        $path = explode('/', $request->path());
        $isAjax = !empty($path[0]) && $path[0] == 'v1' ? true : false;

        if ($exception instanceof ModelNotFoundException) {



            if ($isAjax) {
                return response()->json([
                    'status' => 0,
                    'result' => new \stdClass(),
                    'message' => 'Not Found',
                ], 404);
            }
        }

        if($exception instanceof AuthenticationException)
        {

            if (empty($request->all()) && $path[1] != 'v1')
            {
                return redirect(route('adminLogin'));
            }

                return response()->json([
                    'status' => 0,
                    'result' => new \stdClass(),
                    'message' => 'Unauthorized',
                ], 401);

        }
        return parent::render($request, $exception);
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

        $path = explode('/', $request->path());
        $isAjax = !empty($path[0]) && $path[0] == 'api' ? true : false;

        if ($e->response) {
            return $e->response;
        }

        return ($request->expectsJson() || $isAjax)
            ? $this->invalidJson($request, $e)
            : $this->invalid($request, $e);
    }

    /**
     * Convert a validation exception into a JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Validation\ValidationException  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    protected function invalidJson($request, ValidationException $exception)
    {

        $errors = collect($exception->errors())->first();

        $message = '';

        if (!empty($errors[0])) {
            $message = $errors[0];
        }
        return response()->json([
            'status' => 0,
            'result' => new \stdClass(),
            'message' => $message,
        ], 200);
    }


        protected function unauthenticated($request, AuthenticationException $exception)
    {

   

        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        // $guard = array_get($exception->guards(), 0);
        // switch ($guard) {

        // echo $exception->guards()[0]; 
        //  dd($exception->guards());

           switch ($exception->guards()[0]) {
            case 'admin': //depends which guard you failed to auth
                $login = 'admin';
                break;
            case 'user':
                $login = '/';
                break;
            default:
                $login = '/';
                break;
        }

        return redirect()->guest($login);
        
    }
}
