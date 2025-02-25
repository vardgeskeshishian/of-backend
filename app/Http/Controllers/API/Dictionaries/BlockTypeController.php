<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlockTypeResource;
use App\Models\BlockType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BlockTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/block-types',
        description: 'Display a collection of Items.',
        tags: ['BlockTypes'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BlockTypeResource
    {
        return new BlockTypeResource(
            BlockType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/block-types/{id}',
        description: 'Display the specified Item.',
        tags: ['BlockTypes'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BlockType $blockType): BlockTypeResource
    {
        return new BlockTypeResource(
            $blockType,
        );
    }
}
