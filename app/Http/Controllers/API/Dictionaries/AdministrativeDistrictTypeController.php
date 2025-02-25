<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\API\APIController;
use App\Http\Resources\AdministrativeDistrictTypeResource;
use App\Models\AdministrativeDistrictType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdministrativeDistrictTypeController extends APIController
{
    #[OA\Get(
        path: '/v1/administrative-district-types',
        description: 'Display a collection of Items.',
        tags: ['AdministrativeDistrictTypes'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): AdministrativeDistrictTypeResource
    {
        return new AdministrativeDistrictTypeResource(
            AdministrativeDistrictType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/administrative-district-types/{id}',
        description: 'Display the specified Item.',
        tags: ['AdministrativeDistrictTypes'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(AdministrativeDistrictType $administrativeDistrictType): AdministrativeDistrictTypeResource
    {
        return new AdministrativeDistrictTypeResource(
            $administrativeDistrictType,
        );
    }
}
