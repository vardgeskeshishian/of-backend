<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ImageController extends Controller
{
    #[OA\Get(
        path: '/v1/images',
        description: 'Display a collection of Items.',
        tags: ['Image'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): ImageResource
    {
        return new ImageResource(
            Image::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/images/{id}',
        description: 'Display the specified Item.',
        tags: ['Image'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(Image $image): ImageResource
    {
        return new ImageResource(
            $image,
        );
    }
}
