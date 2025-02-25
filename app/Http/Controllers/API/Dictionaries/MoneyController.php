<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoneyResource;
use App\Models\Money;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MoneyController extends Controller
{
    #[OA\Get(
        path: '/v1/moneys',
        description: 'Display a collection of Items.',
        tags: ['Money'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MoneyResource
    {
        return new MoneyResource(
            Money::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/moneys/{id}',
        description: 'Display the specified Item.',
        tags: ['Money'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Money $money): MoneyResource
    {
        return new MoneyResource(
            $money,
        );
    }
}
