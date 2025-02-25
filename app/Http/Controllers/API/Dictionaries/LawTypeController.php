<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\LawTypeResource;
use App\Models\LawType;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LawTypeController extends Controller
{
    #[OA\Get(
        path: '/v1/law-types',
        description: 'Display a collection of Items.',
        tags: ['LawType'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): LawTypeResource
    {
        return new LawTypeResource(
            LawType::query()->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/law-types/{id}',
        description: 'Display the specified Item.',
        tags: ['LawType'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(LawType $lawType): LawTypeResource
    {
        return new LawTypeResource(
            $lawType,
        );
    }
}
