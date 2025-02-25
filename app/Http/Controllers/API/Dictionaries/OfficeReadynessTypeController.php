<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeReadynessTypeResource;
use App\Models\OfficeReadynessType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfficeReadynessTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/office-readyness-types',
        description: 'Display a collection of Items.',
        tags: ['OfficeReadynessType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): OfficeReadynessTypeResource
    {
        return new OfficeReadynessTypeResource(
            OfficeReadynessType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/office-readyness-types/{id}',
        description: 'Display the specified Item.',
        tags: ['OfficeReadynessType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not foundd')]
    public function show(OfficeReadynessType $officeReadynessType): OfficeReadynessTypeResource
    {
        return new OfficeReadynessTypeResource(
            $officeReadynessType,
        );
    }
}
