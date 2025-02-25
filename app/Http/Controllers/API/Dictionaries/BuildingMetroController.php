<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingMetroResource;
use App\Models\BuildingMetro;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingMetroController extends Controller
{
    #[OA\Get(
        path: '/v1/building-metros',
        description: 'Display a collection of Items.',
        tags: ['BuildingMetro'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingMetroResource
    {
        return new BuildingMetroResource(
            BuildingMetro::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/building-metros/{id}',
        description: 'Display the specified Item.',
        tags: ['BuildingMetro'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BuildingMetro $buildingMetro): BuildingMetroResource
    {
        return new BuildingMetroResource(
            $buildingMetro,
        );
    }
}
