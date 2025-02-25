<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BusinessCenterResource;
use App\Services\BusinessCenterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class BusinessCenterController extends APIController
{
    public function __construct(
        public BusinessCenterService $businessCenterService,
    ) {}

    #[OA\Get(
        path: '/v1/business-centers/search',
        summary: 'Search for business centers',
        tags: ['BusinessCenters'],
    )]
    #[OA\Parameter(
        name: 'assignment',
        description: 'Assignment type',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            ref: '#/components/schemas/AssignmentsEnum',
        ),
    )]
    #[OA\Parameter(
        name: 'min_cost',
        description: 'Minimum cost filter',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'integer', example: 0),
    )]
    #[OA\Parameter(
        name: 'max_cost',
        description: 'Maximum cost filter',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'integer', example: 100000),
    )]
    #[OA\Parameter(
        name: 'min_area',
        description: 'Minimum area filter',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'integer', example: 0),
    )]
    #[OA\Parameter(
        name: 'max_area',
        description: 'Maximum area filter',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'integer', example: 10000000),
    )]
    #[OA\Parameter(
        name: 'filter_type',
        description: 'Filter type: "rent" or "sale"',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string', example: 'rent'),
    )]
    #[OA\Parameter(
        name: 'has_parking',
        description: 'Filter by availability of parking',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'boolean', example: true),
    )]
    #[OA\Parameter(
        name: 'is_furnished',
        description: 'Filter by furnished status',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'boolean', example: false),
    )]
    #[OA\Parameter(
        name: 'block_types[]',
        description: 'Filter by block types',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'string'),
            example: ['office'],
        ),
    )]
    #[OA\Parameter(
        name: 'office_readyness_types[]',
        description: 'Filter by office_readyness_types',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'string'),
        ),
    )]
    #[OA\Parameter(
        name: 'office_layout_types[]',
        description: 'Filter by office_layout_types',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'string'),
        ),
    )]
    #[OA\Parameter(
        name: 'time_foot[]',
        description: 'Filter by metro time foot (distance to metro)',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'integer'),
            example: [5],
        ),
    )]
    #[OA\Parameter(
        name: 'district_types[]',
        description: 'Filter by district types',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'string'),
            example: ['downtown'],
        ),
    )]
    #[OA\Parameter(
        name: 'search',
        description: 'Search term for filtering by name or address',
        in: 'query',
        required: false,
        schema: new OA\Schema(type: 'string', example: 'office building'),
    )]
    #[OA\Parameter(
        name: 'class_codes[]',
        description: 'Filter by class codes',
        in: 'query',
        required: false,
        schema: new OA\Schema(
            type: 'array',
            items: new OA\Items(type: 'string'),
            example: ['A'],
        ),
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully fetched the business centers based on the search filters',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'array', items: new OA\Items('#/components/schemas/BusinessCenterResource')),
            ],
            type: 'object',
        ),
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad request',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: false),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid filter parameters'),
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
    public function search(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            return BusinessCenterResource::collection(
                $this->businessCenterService->search($request),
            );
        } catch (\Exception $e) {
            Log::channel('business-center')->debug(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->errorResponse(
                message: self::SUPPORT_ERROR,
            );
        }
    }


    #[OA\Get(
        path: '/v1/business-centers/coordinates',
        summary: 'Get BC coordinates',
        tags: ['BusinessCenters'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully fetched the business centers based on the search filters',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'object',
                    additionalProperties: new OA\AdditionalProperties(
                        properties: [
                            new OA\Property(property: 'latitude', type: 'number', format: 'float'),
                            new OA\Property(property: 'longitude', type: 'number', format: 'float'),
                        ],
                        type: 'object',
                    ),
                ),
            ],
            type: 'object',
        ),
    )]
    #[OA\Response(
        response: 400,
        description: 'Bad request',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: false),
                new OA\Property(property: 'message', type: 'string', example: 'Invalid filter parameters'),
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
    public function coordinates(Request $request): JsonResponse
    {
        try {
            return $this->successResponse(
                data: $this->businessCenterService->coordinates($request),
            );
        } catch (\Exception $e) {
            Log::channel('business-center')->debug(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->errorResponse(
                message: self::SUPPORT_ERROR,
            );
        }
    }
}
