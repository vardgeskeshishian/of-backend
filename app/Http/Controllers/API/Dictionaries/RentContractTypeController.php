<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentContractTypeResource;
use App\Models\RentContractType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RentContractTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/rent-contract-types',
        description: 'Display a collection of Items.',
        tags: ['RentContractType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): RentContractTypeResource
    {
        return new RentContractTypeResource(
            RentContractType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/rent-contract-types/{id}',
        description: 'Display the specified Item.',
        tags: ['RentContractType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(RentContractType $rentContractType): RentContractTypeResource
    {
        return new RentContractTypeResource(
            $rentContractType,
        );
    }
}
