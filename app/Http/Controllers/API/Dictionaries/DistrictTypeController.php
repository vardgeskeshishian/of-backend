<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictTypeResource;
use App\Models\DistrictType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DistrictTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/district-types',
        description: 'Display a collection of Items.',
        tags: ['DistrictType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): DistrictTypeResource
    {
        return new DistrictTypeResource(
            DistrictType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/district-types/{id}',
        description: 'Display the specified Item.',
        tags: ['DistrictType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(DistrictType $districtType): DistrictTypeResource
    {
        return new DistrictTypeResource(
            $districtType,
        );
    }
}
