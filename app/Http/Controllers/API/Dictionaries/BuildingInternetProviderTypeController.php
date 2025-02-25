<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingInternetProviderTypeResource;
use App\Models\BuildingInternetProviderType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingInternetProviderTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/building-internet-providers',
        description: 'Display a collection of Items.',
        tags: ['BuildingInternetProviderType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingInternetProviderTypeResource
    {
        return new BuildingInternetProviderTypeResource(
            BuildingInternetProviderType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/building-internet-providers/{id}',
        description: 'Display the specified Item.',
        tags: ['BuildingInternetProviderType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BuildingInternetProviderType $buildingInternetProviderType): BuildingInternetProviderTypeResource
    {
        return new BuildingInternetProviderTypeResource(
            $buildingInternetProviderType,
        );
    }
}
