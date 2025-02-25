<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonBlockFloorTypeResource;
use App\Models\CommonBlockFloorType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommonBlockFloorTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/common-block-floor-types',
        description: 'Display a collection of Items.',
        tags: ['CommonBlockFloorType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CommonBlockFloorTypeResource
    {
        return new CommonBlockFloorTypeResource(
            CommonBlockFloorType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/common-block-floor-types/{id}',
        description: 'Display the specified Item.',
        tags: ['CommonBlockFloorType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CommonBlockFloorType $commonBlockFloorType): CommonBlockFloorTypeResource
    {
        return new CommonBlockFloorTypeResource(
            $commonBlockFloorType,
        );
    }
}
