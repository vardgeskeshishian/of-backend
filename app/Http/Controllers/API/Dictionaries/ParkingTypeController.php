<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkingTypeResource;
use App\Models\ParkingType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ParkingTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/parking-types',
        description: 'Display a collection of Items.',
        tags: ['ParkingType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ParkingTypeResource
    {
        return new ParkingTypeResource(
            ParkingType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/parking-types/{id}',
        description: 'Display the specified Item.',
        tags: ['ParkingType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(ParkingType $parkingType): ParkingTypeResource
    {
        return new ParkingTypeResource(
            $parkingType,
        );
    }
}
