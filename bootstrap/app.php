<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Http\Request $request, \Throwable $e) {
            if ($request->is('api/*') || $request->expectsJson()) {
                if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    return \App\Helpers\ApiResponse::notFound(
                        'The requested resource was not found.',
                        'No se encontró el recurso solicitado en la base de datos.'
                    );
                }

                if ($e instanceof \Illuminate\Routing\Exception\RouteNotFoundException) {
                    return \App\Helpers\ApiResponse::notFound(
                        'The requested route was not found.',
                        'La ruta especificada no existe.'
                    );
                }

                if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    return \App\Helpers\ApiResponse::error(
                        401,
                        'UNAUTHORIZED',
                        'Authentication required.',
                        'Debe autenticarse para acceder a este recurso.',
                        'Incluya el token de autenticación en el header Authorization.'
                    );
                }

                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    return \App\Helpers\ApiResponse::validationError(
                        'Validation failed.',
                        $e->errors()
                    );
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
                    return \App\Helpers\ApiResponse::methodNotAllowed();
                }

                return \App\Helpers\ApiResponse::error(
                    500,
                    'INTERNAL_SERVER_ERROR',
                    'An unexpected error occurred.',
                    $e->getMessage(),
                    'Contacte al administrador del sistema.'
                );
            }
        });
    })->create();
