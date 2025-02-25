<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class PageController extends APIController
{
    #[OA\Get(
        path: '/v1/pages',
        summary: 'Get pages',
        tags: ['Pages'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully fetched',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'array', items: new OA\Items('#/components/schemas/PageResource')),
            ],
            type: 'object',
        ),
    )]
    public function index(): JsonResource
    {
        return PageResource::collection(
            Page::query()->select(['id', 'name', 'slug'])->get(),
        );
    }

    #[OA\Get(
        path: '/v1/pages/{slug}',
        summary: 'Get the page',
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
        description: 'Successfully fetched the pages',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', type: 'array', items: new OA\Items('#/components/schemas/PageResource')),
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
    public function show(Page $page): PageResource|JsonResponse
    {
        try {
            $page->load('blocks.items', 'blocks.menus.categories.items');
            return new PageResource(
                $page,
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
