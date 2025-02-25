<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PageBlockResource;
use App\Models\PageBlock;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class PageBlockController extends APIController
{
    #[OA\Get(
        path: '/v1/blocks',
        summary: 'Get page blocks',
        tags: ['Pages'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully fetched',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'array', items: new OA\Items('#/components/schemas/PageBlockResource')),
            ],
            type: 'object',
        ),
    )]
    public function index(): JsonResource
    {
        return PageBlockResource::collection(
            PageBlock::query()->select(['id', 'name', 'slug'])->get(),
        );
    }

    #[OA\Get(
        path: '/v1/blocks/{slug}',
        summary: 'Get page block',
        tags: ['Pages'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                description: 'The slug',
                in: 'path',
                required: true,
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully fetched',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'array', items: new OA\Items('#/components/schemas/PageBlockResource')),
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
    public function show(PageBlock $block): PageBlockResource|JsonResponse
    {
        try {
            $block->load('items', 'menus.categories.items');
            return new PageBlockResource(
                $block,
            );
        } catch (\Exception $e) {
            Log::debug(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return $this->errorResponse();
        }

    }
}
