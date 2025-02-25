<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\API\AdministrativeDistrictTypeResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingInfrastructureTypeResource;
use App\Models\BuildingInfrastructureType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingInfrastructureTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/building-infrastructure-types',
        description: 'Display a collection of Items.',
        tags: ['BuildingInfrastructureType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingInfrastructureTypeResource
    {
        return new BuildingInfrastructureTypeResource(
            BuildingInfrastructureType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/building-infrastructure-types/{id}',
        description: 'Display the specified Item.',
        tags: ['BuildingInfrastructureType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BuildingInfrastructureType $buildingInfrastructureType): AdministrativeDistrictTypeResource
    {
        return new AdministrativeDistrictTypeResource(
            $buildingInfrastructureType,
        );
    }
}
