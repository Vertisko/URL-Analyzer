<?php


namespace App\Http;

use Illuminate\Http\JsonResponse;

class ResponseFactory
{
    public static function createSuccessfulResponse($data, int $statusCode = 200, array $headers = []): JsonResponse
    {
        return JsonResponse::create(["data" => $data], $statusCode, $headers);
    }

    public static function createFailedResponse(array $errors, int $statusCode, array $headers = [])
    {
        return JsonResponse::create(["errors" => $errors], $statusCode, $headers);
    }
}
