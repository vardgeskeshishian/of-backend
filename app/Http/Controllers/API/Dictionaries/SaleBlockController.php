<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleBlockResource;
use App\Models\SaleBlock;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SaleBlockController extends Controller
{
    #[OA\Get(
        path: '/v1/sale-blocks',
        description: 'Display a collection of Items.',
        tags: ['SaleBlock'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): SaleBlockResource
    {
        return new SaleBlockResource(
            SaleBlock::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/sale-blocks/{id}',
        description: 'Display the specified Item.',
        tags: ['SaleBlock'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(SaleBlock $saleBlock): SaleBlockResource
    {
        return new SaleBlockResource(
            $saleBlock,
        );
    }
}
