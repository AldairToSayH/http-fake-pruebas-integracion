<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiResponse
{
    public static function error(
        int $statusCode,
        string $code,
        string $message,
        ?string $details = null,
        ?string $sugerencia = null
    ): \Illuminate\Http\JsonResponse {
        $request = request();

        return response()->json([
            'status' => 'error',
            'statusCode' => $statusCode,
            'error' => [
                'code' => $code,
                'message' => $message,
                'details' => $details,
                'timestamp' => now()->toIso8601String(),
                'path' => $request->getRequestUri(),
                'sugerencia' => $sugerencia,
            ],
            'requestId' => Str::uuid()->toString(),
            'url_documentación' => config('app.url') . '/docs/errors',
        ], $statusCode);
    }

    public static function notFound(?string $message = null, ?string $details = null): \Illuminate\Http\JsonResponse
    {
        return self::error(
            404,
            'RESOURCE_NOT_FOUND',
            $message ?? 'The requested resource was not found.',
            $details,
            'Verifique si el ID es correcto o consulte nuestra documentación para obtener más información'
        );
    }

    public static function validationError(string $message, array $details): \Illuminate\Http\JsonResponse
    {
        return self::error(
            422,
            'VALIDATION_ERROR',
            $message,
            json_encode($details),
            'Verifique los campos obligatorios y el formato de los datos.'
        );
    }

    public static function methodNotAllowed(?string $message = null): \Illuminate\Http\JsonResponse
    {
        return self::error(
            405,
            'METHOD_NOT_ALLOWED',
            $message ?? 'The requested method is not allowed for this endpoint.',
            null,
            'Verifique los métodos HTTP permitidos para este endpoint.'
        );
    }
}