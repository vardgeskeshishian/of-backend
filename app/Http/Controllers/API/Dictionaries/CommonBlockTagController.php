<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonBlockTagResource;
use App\Models\CommonBlockTag;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommonBlockTagController extends Controller
{
    #[OA\Get(
        path: '/v1/common-block-tags',
        description: 'Display a collection of Items.',
        tags: ['CommonBlockTag'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CommonBlockTagResource
    {
        return new CommonBlockTagResource(
            CommonBlockTag::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/common-block-tags/{id}',
        description: 'Display the specified Item.',
        tags: ['CommonBlockTag'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CommonBlockTag $blockTag): CommonBlockTagResource
    {
        return new CommonBlockTagResource(
            $blockTag,
        );
    }
}
