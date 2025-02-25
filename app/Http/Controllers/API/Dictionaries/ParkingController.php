<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ParkingController extends Controller
{
    #[OA\Get(
        path: '/v1/parkings',
        description: 'Display a collection of Items.',
        tags: ['Parking'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ParkingResource
    {
        return new ParkingResource(
            Parking::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/parkings/{id}',
        description: 'Display the specified Item.',
        tags: ['Parking'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Parking $parking): ParkingResource
    {
        return new ParkingResource(
            $parking,
        );
    }
}
