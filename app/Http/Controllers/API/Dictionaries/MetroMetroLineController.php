<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetroMetroLineResource;
use App\Models\MetroMetroLine;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MetroMetroLineController extends Controller
{
    #[OA\Get(
        path: '/v1/metro-metro-lines',
        description: 'Display a collection of Items.',
        tags: ['MetroMetroLine'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MetroMetroLineResource
    {
        return new MetroMetroLineResource(
            MetroMetroLine::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/metro-metro-lines/{id}',
        description: 'Display the specified Item.',
        tags: ['MetroMetroLine'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(MetroMetroLine $metroLine): MetroMetroLineResource
    {
        return new MetroMetroLineResource(
            $metroLine,
        );
    }
}
