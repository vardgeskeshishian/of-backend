<?php

namespace App\Http\Controllers\API;

use App\Services\FilterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class FilterController extends APIController
{
    public function __construct(public FilterService $service) {}

    #[OA\Get(
        path: '/v1/filters',
        description: 'Retrieve available filter options for select boxes.',
        tags: ['DefaultFilters'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean'),
                new OA\Property(
                    property: 'data',
                    properties: [
                        new OA\Property(property: 'min_area', type: 'integer'),
                        new OA\Property(property: 'max_area', type: 'integer'),
                        new OA\Property(property: 'min_cost', type: 'string'),
                        new OA\Property(property: 'max_cost', type: 'string'),
                        new OA\Property(
                            property: 'metros',
                            type: 'array',
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: 'id', type: 'integer'),
                                    new OA\Property(property: 'name', type: 'string'),
                                ],
                            ),
                        ),
                        new OA\Property(
                            property: 'district_types',
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
                new OA\Property(property: 'message', type: 'string'),
            ],
        ),
    )]
    public function filters(Request $request): JsonResponse
    {
        try {
            return $this->successResponse(
                data: $this->service->getFilters($request),
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }
}
