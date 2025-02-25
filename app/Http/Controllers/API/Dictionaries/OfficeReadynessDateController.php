<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\OfficeReadynessDateResource;
use App\Models\OfficeReadynessDate;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class OfficeReadynessDateController extends Controller
{
    #[OA\Get(
        path: '/v1/office-readyness-dates',
        description: 'Display a collection of Items.',
        tags: ['OfficeReadynessDate'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): OfficeReadynessDateResource
    {
        return new OfficeReadynessDateResource(
            OfficeReadynessDate::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/office-readyness-dates/{id}',
        description: 'Display the specified Item.',
        tags: ['OfficeReadynessDate'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(OfficeReadynessDate $officeReadynessDate): OfficeReadynessDateResource
    {
        return new OfficeReadynessDateResource(
            $officeReadynessDate,
        );
    }
}
