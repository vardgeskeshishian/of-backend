<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetroLineResource;
use App\Models\MetroLine;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MetroLineController extends Controller
{
    #[OA\Get(
        path: '/v1/metro-lines',
        description: 'Display a collection of Items.',
        tags: ['MetroLine'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MetroLineResource
    {
        return new MetroLineResource(
            MetroLine::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/metro-lines/{id}',
        description: 'Display the specified Item.',
        tags: ['MetroLine'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(MetroLine $metroLine): MetroLineResource
    {
        return new MetroLineResource(
            $metroLine,
        );
    }
}
