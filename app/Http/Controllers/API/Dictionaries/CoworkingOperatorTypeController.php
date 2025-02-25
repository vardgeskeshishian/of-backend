<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoworkingOperatorTypeResource;
use App\Models\CoworkingOperatorType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CoworkingOperatorTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/coworking-operator-types',
        description: 'Display a collection of Items.',
        tags: ['CoworkingOperatorType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CoworkingOperatorTypeResource
    {
        return new CoworkingOperatorTypeResource(
            CoworkingOperatorType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/coworking-operator-types/{id}',
        description: 'Display the specified Item.',
        tags: ['CoworkingOperatorType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CoworkingOperatorType $coworkingOperatorType): CoworkingOperatorTypeResource
    {
        return new CoworkingOperatorTypeResource(
            $coworkingOperatorType,
        );
    }
}
