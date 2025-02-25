<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlockForVacationResource;
use App\Models\BlockForVacation;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BlockForVacationController extends Controller
{
    #[OA\Get(
        path: '/v1/block-for-vacations',
        description: 'Display a collection of Items.',
        tags: ['BlockForVacation'],
    )]
    #[OA\Response(response: ResponseAlias::HTTP_OK, description: 'OK')]
    public function index(): AnonymousResourceCollection
    {
        return BlockForVacationResource::collection(
            BlockForVacation::query()
                ->with([
                    'commonBlock',
                    'periodVacationType',
                ])
                ->paginate(),
        );
    }

    #[OA\Get(
        path: '/v1/block-for-vacations/{id}',
        description: 'Display the specified Item.',
        tags: ['BlockForVacation'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(BlockForVacation $blockForVacation): BlockForVacationResource
    {
        return new BlockForVacationResource(
            $blockForVacation,
        );
    }
}
