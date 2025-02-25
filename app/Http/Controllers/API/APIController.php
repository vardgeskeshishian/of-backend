<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

#[OA\Info(version: "1.0.0", title: "OF.ru")]
class APIController extends Controller
{
    protected const string SUPPORT_ERROR = 'Error while searching result, please contact wih support!';

    protected const string CHECK_LOG_ERROR = 'Error, check logs';

    protected function successResponse(
        bool $status = true,
        $data = [],
        int $code = ResponseAlias::HTTP_OK,
        string $message = 'success',
    ): \Illuminate\Http\JsonResponse {
        return response()->json([
            'status' => $status,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    protected function errorResponse(
        bool $status = false,
        string $message = self::CHECK_LOG_ERROR,
        int $code = 500,
    ): \Illuminate\Http\JsonResponse {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $code);
    }
}
