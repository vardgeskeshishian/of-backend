<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExteriorWallTypeResource;
use App\Models\ExteriorWallType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ExteriorWallTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/exterior-wall-types',
        description: 'Display a collection of Items.',
        tags: ['ExteriorWallType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ExteriorWallTypeResource
    {
        return new ExteriorWallTypeResource(
            ExteriorWallType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/exterior-wall-types/{id}',
        description: 'Display the specified Item.',
        tags: ['ExteriorWallType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(ExteriorWallType $exteriorWallType): ExteriorWallTypeResource
    {
        return new ExteriorWallTypeResource(
            $exteriorWallType,
        );
    }
}
