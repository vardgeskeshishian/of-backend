<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonBlockImageResource;
use App\Models\CommonBlockImage;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CommonBlockImageController extends Controller
{
    #[OA\Get(
        path: '/v1/common-block-images',
        description: 'Display a collection of Items.',
        tags: ['CommonBlockImage'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): CommonBlockImageResource
    {
        return new CommonBlockImageResource(
            CommonBlockImage::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/common-block-images/{id}',
        description: 'Display the specified Item.',
        tags: ['CommonBlockImage'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(CommonBlockImage $commonBlockImage): CommonBlockImageResource
    {
        return new CommonBlockImageResource(
            $commonBlockImage,
        );
    }
}
