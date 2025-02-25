<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingTagResource;
use App\Models\BuildingTag;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingTagController extends Controller
{
    #[OA\Get(
        path: '/v1/building-tags',
        description: 'Display a collection of Items.',
        tags: ['BuildingTag'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingTagResource
    {
        return new BuildingTagResource(
            BuildingTag::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/building-tags/{id}',
        description: 'Display the specified Item.',
        tags: ['BuildingTag'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BuildingTag $buildingTag): BuildingTagResource
    {
        return new BuildingTagResource(
            $buildingTag,
        );
    }
}
