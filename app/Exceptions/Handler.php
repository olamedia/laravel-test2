<?php
declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;

final class Handler extends ExceptionHandler
{
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
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json([
                'errors' => [
                    [
                        'title' => 'Unauthorized',
                        'status' => '403',
                        'detail' => 'User don\'t have the permissions required.',
                    ]
                ]
            ]);
        }

        return parent::render($request, $exception);
    }

    /**
     * Report or log an exception.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
//
//    /**
//     * Prepare a JSON response for the given exception.
//     *
//     * @param \Illuminate\Http\Request $request
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    protected function prepareJsonResponse($request, Throwable $e)
//    {
//        $data = $this->convertExceptionToArray($e);
//        $status = $this->isHttpException($e) ? $e->getStatusCode() : 500;
//
//        return new JsonResponse(
//            ['errors' => [$data]],
//            $status,
//            $this->isHttpException($e) ? $e->getHeaders() : [],
//            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
//        );
//    }
}
