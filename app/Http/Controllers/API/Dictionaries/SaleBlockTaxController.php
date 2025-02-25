<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleBlockTaxResource;
use App\Models\SaleBlockTax;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SaleBlockTaxController extends Controller
{
    #[OA\Get(
        path: '/v1/sale-block-taxes',
        description: 'Display a collection of Items.',
        tags: ['SaleBlockTax'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): SaleBlockTaxResource
    {
        return new SaleBlockTaxResource(
            SaleBlockTax::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/sale-block-taxes/{id}',
        description: 'Display the specified Item.',
        tags: ['SaleBlockTax'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(SaleBlockTax $saleBlockTax): SaleBlockTaxResource
    {
        return new SaleBlockTaxResource(
            $saleBlockTax,
        );
    }
}
