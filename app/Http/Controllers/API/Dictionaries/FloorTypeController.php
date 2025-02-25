<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\FloorTypeResource;
use App\Models\FloorType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FloorTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/floor-types',
        description: 'Display a collection of Items.',
        tags: ['FloorType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): FloorTypeResource
    {
        return new FloorTypeResource(
            FloorType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/floor-types/{id}',
        description: 'Display the specified Item.',
        tags: ['FloorType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(FloorType $floorType): FloorTypeResource
    {
        return new FloorTypeResource(
            $floorType,
        );
    }
}
