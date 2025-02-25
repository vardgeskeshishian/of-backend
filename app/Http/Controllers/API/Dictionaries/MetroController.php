<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetroResource;
use App\Models\Metro;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MetroController extends Controller
{
    #[OA\Get(
        path: '/v1/metros',
        description: 'Display a collection of Items.',
        tags: ['Metro'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MetroResource
    {
        return new MetroResource(
            Metro::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/metros/{id}',
        description: 'Display the specified Item.',
        tags: ['Metro'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Metro $metro): MetroResource
    {
        return new MetroResource(
            $metro,
        );
    }
}
