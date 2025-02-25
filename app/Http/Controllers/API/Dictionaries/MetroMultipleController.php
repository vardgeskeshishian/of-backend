<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetroMultipleResource;
use App\Models\MetroMultiple;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MetroMultipleController extends Controller
{
    #[OA\Get(
        path: '/v1/metro-multiples',
        description: 'Display a collection of Items.',
        tags: ['MetroMultiple'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): MetroMultipleResource
    {
        return new MetroMultipleResource(
            MetroMultiple::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/metro-multiples/{id}',
        description: 'Display the specified Item.',
        tags: ['MetroMultiple'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(MetroMultiple $metroMultiple): MetroMultipleResource
    {
        return new MetroMultipleResource(
            $metroMultiple,
        );
    }
}
