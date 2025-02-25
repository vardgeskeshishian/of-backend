<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\InfrastructureTypeResource;
use App\Models\InfrastructureType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class InfrastructureTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/infrastructure-types',
        description: 'Display a collection of Items.',
        tags: ['InfrastructureType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): InfrastructureTypeResource
    {
        return new InfrastructureTypeResource(
            InfrastructureType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/infrastructure-types/{id}',
        description: 'Display the specified Item.',
        tags: ['InfrastructureType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(InfrastructureType $infrastructureType): InfrastructureTypeResource
    {
        return new InfrastructureTypeResource(
            $infrastructureType,
        );
    }
}
