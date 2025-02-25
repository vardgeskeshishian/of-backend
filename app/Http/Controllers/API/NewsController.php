<?php

namespace App\Http\Controllers\API;

use OpenApi\Attributes as OA;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;

class NewsController extends APIController
{
    #[OA\Get(
        path: '/v1/news',
        description: 'Display a collection of Items.',
        tags: ['News'],
    )]
    #[OA\Response(
        response: 200,
        description: 'OK',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items('#/components/schemas/NewsResource'),
                ),
            ],
            type: 'object',
        ),
    )]
    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            return NewsResource::collection(
                News::query()->with('attachments')->paginate(),
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Error, check logs',
            ]);
        }
    }

    #[OA\Get(
        path: '/v1/news/{slug}',
        description: 'Display a single news item by slug.',
        tags: ['News'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                description: 'The slug of the news item',
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
                new OA\Property(property: 'data', ref: '#/components/schemas/NewsResource'),
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
    public function show(News $news): NewsResource|JsonResponse
    {
        try {
            $news->load('blocks.attachments');
            return new NewsResource(
                $news,
            );
        } catch (\Exception $e) {
            Log::error(self::class . ' Error: ' . $e->getMessage());
            return $this->errorResponse();
        }
    }
}
