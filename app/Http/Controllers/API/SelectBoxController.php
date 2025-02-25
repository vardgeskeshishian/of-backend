<?php

namespace App\Http\Controllers\API;

use App\Services\SelectBoxService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class SelectBoxController extends APIController
{
    public function __construct(public SelectBoxService $service) {}

    #[OA\Get(
        path: '/v1/select/{table_name}',
        description: 'Display a collection of Items for the given table.',
        tags: ['SelectBoxData'],
    )]
    #[OA\Parameter(
        name: 'table_name',
        description: 'The name of the table to fetch data from dynamically',
        in: 'path',
        required: true,
        schema: new OA\Schema(type: 'string', example: 'users'),
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id', type: 'integer'),
                            new OA\Property(property: 'name', type: 'string'),
                        ],
                    ),
                ),
            ],
            type: 'object',
        ),
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad request, invalid table name or query parameters',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: false),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid table name or parameters'),
            ],
        ),
    )]
    #[OA\Response(
        response: 500,
        description: 'Internal server error',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: false),
                new OA\Property(property: 'message', type: 'string', example: 'An error occurred, please try again later'),
            ],
        ),
    )]
    public function select(Request $request, $table): JsonResponse
    {
        try {
            return $this->successResponse(
                data: $this->service->select($request, $table),
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }
}
