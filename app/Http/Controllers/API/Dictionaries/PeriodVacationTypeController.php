<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodVacationTypeResource;
use App\Models\PeriodVacationType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PeriodVacationTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/period-vacation-types',
        description: 'Display a collection of Items.',
        tags: ['PeriodVacationType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): PeriodVacationTypeResource
    {
        return new PeriodVacationTypeResource(
            PeriodVacationType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/period-vacation-types/{id}',
        description: 'Display the specified Item.',
        tags: ['PeriodVacationType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(PeriodVacationType $periodVacationType): PeriodVacationTypeResource
    {
        return new PeriodVacationTypeResource(
            $periodVacationType,
        );
    }
}
