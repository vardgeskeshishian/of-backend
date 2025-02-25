<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\TargetSalesTypeResource;
use App\Models\TargetSalesType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TargetSalesTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/target-sales-types',
        description: 'Display a collection of Items.',
        tags: ['TargetSalesType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): TargetSalesTypeResource
    {
        return new TargetSalesTypeResource(
            TargetSalesType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/target-sales-types/{id}',
        description: 'Display the specified Item.',
        tags: ['TargetSalesType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(TargetSalesType $targetSalesType): TargetSalesTypeResource
    {
        return new TargetSalesTypeResource(
            $targetSalesType,
        );
    }
}
