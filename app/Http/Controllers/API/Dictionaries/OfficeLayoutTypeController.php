<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeLayoutTypeResource;
use App\Models\OfficeLayoutType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfficeLayoutTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/office-layout-types',
        description: 'Display a collection of Items.',
        tags: ['OfficeLayoutType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): OfficeLayoutTypeResource
    {
        return new OfficeLayoutTypeResource(
            OfficeLayoutType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/office-layout-types/{id}',
        description: 'Display the specified Item.',
        tags: ['OfficeLayoutType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(OfficeLayoutType $officeLayoutType): OfficeLayoutTypeResource
    {
        return new OfficeLayoutTypeResource(
            $officeLayoutType,
        );
    }
}
