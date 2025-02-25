<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentBlockTaxResource;
use App\Models\RentBlockTax;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RentBlockTaxController extends Controller
{
    #[OA\Get(
        path: '/v1/rent-block-taxes',
        description: 'Display a collection of Items.',
        tags: ['RentBlockTax'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): RentBlockTaxResource
    {
        return new RentBlockTaxResource(
            RentBlockTax::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/rent-block-taxes/{id}',
        description: 'Display the specified Item.',
        tags: ['RentBlockTax'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(RentBlockTax $rentBlockTax): RentBlockTaxResource
    {
        return new RentBlockTaxResource(
            $rentBlockTax,
        );
    }
}
