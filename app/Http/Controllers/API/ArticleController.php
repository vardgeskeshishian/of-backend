<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;

class ArticleController extends APIController
{
    #[OA\Get(
        path: '/v1/articles',
        description: 'Display a collection of Items.',
        tags: ['Articles'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items('#/components/schemas/ArticleResource'),
                ),
            ],
            type: 'object',
        ),
    )]
    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            return ArticleResource::collection(
                Article::query()->paginate(),
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }

    #[OA\Get(
        path: '/v1/articles/{slug}',
        description: 'Display a single item by slug.',
        tags: ['Articles'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                description: 'The slug of the item',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string'),
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'data', ref: '#/components/schemas/ArticleResource'),
            ],
            type: 'object',
        ),
    )]
    #[OA\Response(
        response: 404,
        description: 'Not Found',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'message', type: 'string', example: 'Resource not found'),
            ],
        ),
    )]
    public function show(Article $article): ArticleResource|JsonResponse
    {
        try {
            return new ArticleResource(
                $article,
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }
}
