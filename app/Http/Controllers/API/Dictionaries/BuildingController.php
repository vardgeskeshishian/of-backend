<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingResource;
use App\Http\Resources\BusinessCenterResource;
use App\Models\Building;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingController extends Controller
{
    #[OA\Get(
        path: '/v1/buildings',
        description: 'Display a collection of Items.',
        tags: ['Building'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingResource
    {
        return new BuildingResource(
            Building::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/buildings/{id}',
        description: 'Display the specified Item.',
        tags: ['Building'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Building $building): BusinessCenterResource
    {
        return new BusinessCenterResource(
            $building->load([
                'images',
                'metros',
            ]),
        );
    }
}
