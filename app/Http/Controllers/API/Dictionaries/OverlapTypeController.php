<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\OverlapTypeResource;
use App\Models\OverlapType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OverlapTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/overlap-types',
        description: 'Display a collection of Items.',
        tags: ['OverlapType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): OverlapTypeResource
    {
        return new OverlapTypeResource(
            OverlapType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/overlap-types/{id}',
        description: 'Display the specified Item.',
        tags: ['OverlapType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(OverlapType $overlapType): OverlapTypeResource
    {
        return new OverlapTypeResource(
            $overlapType,
        );
    }
}
