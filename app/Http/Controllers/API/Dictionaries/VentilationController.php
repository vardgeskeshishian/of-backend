<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\VentilationResource;
use App\Models\Ventilation;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class VentilationController extends Controller
{
    #[OA\Get(
        path: '/v1/ventilations',
        description: 'Display a collection of Items.',
        tags: ['Ventilation'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): VentilationResource
    {
        return new VentilationResource(
            Ventilation::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/ventilations/{id}',
        description: 'Display the specified Item.',
        tags: ['Ventilation'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Ventilation $ventilation): VentilationResource
    {
        return new VentilationResource(
            $ventilation,
        );
    }
}
