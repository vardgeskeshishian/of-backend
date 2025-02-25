<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\API\APIController;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AssignmentController extends APIController
{
    #[OA\Get(
        path: '/v1/assignments',
        description: 'Display a collection of Items.',
        tags: ['Assignment'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): AssignmentResource
    {
        return new AssignmentResource(
            Assignment::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/assignments/{id}',
        description: 'Display the specified Item.',
        tags: ['Assignment'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Assignment $assignment): AssignmentResource
    {
        return new AssignmentResource(
            $assignment,
        );
    }
}
