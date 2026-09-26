<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
    }

    public function render($request, Throwable $e)
    {
        if ($this->shouldRender404($e)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Not Found',
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $e);
    }

    protected function shouldRender404(Throwable $e): bool
    {
        if (
            $e instanceof NotFoundHttpException ||
            $e instanceof ModelNotFoundException ||
            $e instanceof RouteNotFoundException
        ) {
            return true;
        }

        return $e instanceof \InvalidArgumentException
            && str_contains($e->getMessage(), 'View [')
            && str_contains($e->getMessage(), 'not found');
    }
}
