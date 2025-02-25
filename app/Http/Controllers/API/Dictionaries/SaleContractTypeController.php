<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleContractTypeResource;
use App\Models\SaleContractType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SaleContractTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/sale-contract-types',
        description: 'Display a collection of Items.',
        tags: ['SaleContractType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): SaleContractTypeResource
    {
        return new SaleContractTypeResource(
            SaleContractType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/sale-contract-types/{id}',
        description: 'Display the specified Item.',
        tags: ['SaleContractType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(SaleContractType $saleContractType): SaleContractTypeResource
    {
        return new SaleContractTypeResource(
            $saleContractType,
        );
    }
}
