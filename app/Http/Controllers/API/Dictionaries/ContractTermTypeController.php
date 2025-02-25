<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractTermTypeResource;
use App\Models\ContractTermType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ContractTermTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/contract-term-types',
        description: 'Display a collection of Items.',
        tags: ['ContractTermType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ContractTermTypeResource
    {
        return new ContractTermTypeResource(
            ContractTermType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/contract-term-types/{id}',
        description: 'Display the specified Item.',
        tags: ['ContractTermType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(ContractTermType $contractTermType): ContractTermTypeResource
    {
        return new ContractTermTypeResource(
            $contractTermType,
        );
    }
}
