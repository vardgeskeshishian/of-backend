<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\UtilityCostsTypeResource;
use App\Models\UtilityCostsType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UtilityCostsTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/utility-costs-types',
        description: 'Display a collection of Items.',
        tags: ['UtilityCostsType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): UtilityCostsTypeResource
    {
        return new UtilityCostsTypeResource(
            UtilityCostsType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/utility-costs-types/{id}',
        description: 'Display the specified Item.',
        tags: ['UtilityCostsType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(UtilityCostsType $utilityCostsType): UtilityCostsTypeResource
    {
        return new UtilityCostsTypeResource(
            $utilityCostsType,
        );
    }
}
