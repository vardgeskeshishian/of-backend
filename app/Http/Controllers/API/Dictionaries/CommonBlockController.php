<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonBlockResource;
use App\Models\CommonBlock;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommonBlockController extends Controller
{
    #[OA\Get(
        path: '/v1/common-blocks',
        description: 'Display a collection of Items.',
        tags: ['CommonBlock'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): JsonResource
    {
        return CommonBlockResource::collection(
            CommonBlock::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/common-blocks/{id}',
        description: 'Display the specified Item.',
        tags: ['CommonBlock'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CommonBlock $commonBlock): CommonBlockResource
    {
        return new CommonBlockResource(
            $commonBlock,
        );
    }
}
