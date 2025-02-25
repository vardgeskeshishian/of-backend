<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaxTypeResource;
use App\Models\TaxType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaxTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/tax-types',
        description: 'Display a collection of Items.',
        tags: ['TaxType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): TaxTypeResource
    {
        return new TaxTypeResource(
            TaxType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/tax-types/{id}',
        description: 'Display the specified Item.',
        tags: ['TaxType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(TaxType $taxType): TaxTypeResource
    {
        return new TaxTypeResource(
            $taxType,
        );
    }
}
