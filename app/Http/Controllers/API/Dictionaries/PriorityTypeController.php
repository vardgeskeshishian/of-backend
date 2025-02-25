<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriorityTypeResource;
use App\Models\PriorityType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PriorityTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/priority-types',
        description: 'Display a collection of Items.',
        tags: ['PriorityType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): PriorityTypeResource
    {
        return new PriorityTypeResource(
            PriorityType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/priority-types/{id}',
        description: 'Display the specified Item.',
        tags: ['PriorityType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(PriorityType $priorityType): PriorityTypeResource
    {
        return new PriorityTypeResource(
            $priorityType,
        );
    }
}
