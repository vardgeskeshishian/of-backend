<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoworkingResource;
use App\Models\Coworking;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CoworkingController extends Controller
{
    #[OA\Get(
        path: '/v1/coworkings',
        description: 'Display a collection of Items.',
        tags: ['Coworking'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CoworkingResource
    {
        return new CoworkingResource(
            Coworking::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/coworkings/{id}',
        description: 'Display the specified Item.',
        tags: ['Coworking'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Coworking $coworking): CoworkingResource
    {
        return new CoworkingResource(
            $coworking,
        );
    }
}
