<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyTypeResource;
use App\Models\CurrencyType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CurrencyTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/currency-types',
        description: 'Display a collection of Items.',
        tags: ['CurrencyType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CurrencyTypeResource
    {
        return new CurrencyTypeResource(
            CurrencyType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/currency-types/{id}',
        description: 'Display the specified Item.',
        tags: ['CurrencyType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CurrencyType $currencyType): CurrencyTypeResource
    {
        return new CurrencyTypeResource(
            $currencyType,
        );
    }
}
