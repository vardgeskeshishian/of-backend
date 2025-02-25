<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConditioningResource;
use App\Models\Conditioning;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ConditioningController extends Controller
{
    #[OA\Get(
        path: '/v1/conditionings',
        description: 'Display a collection of Items.',
        tags: ['Conditionings'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ConditioningResource
    {
        return new ConditioningResource(
            Conditioning::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/conditionings/{id}',
        description: 'Display the specified Item.',
        tags: ['Conditionings'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Conditioning $conditioning): ConditioningResource
    {
        return new ConditioningResource(
            $conditioning,
        );
    }
}
