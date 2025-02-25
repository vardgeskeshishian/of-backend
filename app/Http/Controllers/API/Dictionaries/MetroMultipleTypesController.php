<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetroMultipleTypesResource;
use App\Models\MetroMultipleTypes;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MetroMultipleTypesController extends Controller
{
    #[OA\Get(
        path: '/v1/metro-multiple-types',
        description: 'Display a collection of Items.',
        tags: ['MetroMultipleType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MetroMultipleTypesResource
    {
        return new MetroMultipleTypesResource(
            MetroMultipleTypes::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/metro-multiple-types/{id}',
        description: 'Display the specified Item.',
        tags: ['MetroMultipleType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(MetroMultipleTypes $metroMultipleType): MetroMultipleTypesResource
    {
        return new MetroMultipleTypesResource(
            $metroMultipleType,
        );
    }
}
