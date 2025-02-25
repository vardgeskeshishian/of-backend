<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BuildingImageResource;
use App\Models\BuildingImage;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BuildingImageController extends Controller
{
    #[OA\Get(
        path: '/v1/building-images',
        description: 'Display a collection of Items.',
        tags: ['BuildingImage'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): BuildingImageResource
    {
        return new BuildingImageResource(
            BuildingImage::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/building-images/{id}',
        description: 'Display the specified Item.',
        tags: ['BuildingImage'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BuildingImage $buildingImage): BuildingImageResource
    {
        return new BuildingImageResource(
            $buildingImage,
        );
    }
}
