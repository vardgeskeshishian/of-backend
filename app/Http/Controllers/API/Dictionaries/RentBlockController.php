<?php

namespace App\Http\Controllers\API\Dictionaries;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentBlockResource;
use App\Models\CommonBlock;
use App\Models\Money;
use App\Models\RentBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RentBlockController extends Controller
{
    #[OA\Get(
        path: '/v1/rent-blocks',
        description: 'Display a collection of RentBlock items, with optional filtering and sorting.',
        tags: ['RentBlock'],
        parameters: [
            new OA\Parameter(
                name: 'building',
                description: 'Filter RentBlocks by building name.',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    example: 'some-name',
                ),
            ),
            new OA\Parameter(
                name: 'order_by',
                description: 'Specify the field to sort by. Valid values: area, price.',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    enum: ['area', 'price'],
                    example: 'area',
                ),
            ),
            new OA\Parameter(
                name: 'order_direction',
                description: 'Specify the sorting direction. Valid values: asc, desc.',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                    enum: ['asc', 'desc'],
                    example: 'asc',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'A collection of RentBlock items.',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: '#/components/schemas/RentBlockResource'),
                        ),
                    ],
                    type: 'object',
                ),
            ),
        ],
    )]
    public function index(Request $request): JsonResource
    {

        $building = $request->query('building');

        $direction = $request->get('order_direction', 'asc');

        $blocks = RentBlock::query()
            ->with([
                'priceMeterYear',
                'commonBlock.blockImages.image',
                'commonBlock.building.districtType',
            ])
            ->withWhereHas('commonBlock.building', function ($query) use($building){
                $query->when($building, function ($query) use ($building) {
                    $query->where('name', $building);
                });
            })
            ->when($request->has('order_by'), function ($query) use ($request, $direction) {
                if ($request->order_by === 'area') {
                    $query->orderBy(CommonBlock::select('useful_area')
                        ->whereColumn('common_blocks.id', 'rent_blocks.common_block_id'), $direction
                    );
                }

                if ($request->order_by === 'price') {
                    $query->orderBy(Money::select('value')
                        ->whereColumn('price_meter_years.id', 'rent_blocks.price_meter_year_id'), $direction
                    );
                }
            })
            ->orderBy('id')
            ->paginate();

        return RentBlockResource::collection(
            $blocks,
        );
    }

    #[OA\Get(
        path: '/v1/rent-blocks/{id}',
        description: 'Display the specified Item.',
        tags: ['RentBlock'],
    )]
    #[OA\Parameter(name: "id", in: "path", required: true, schema: new OA\Schema(type: 'number'))]
    #[OA\Response(
        response: ResponseAlias::HTTP_OK,
        description: 'OK',
    )]
    #[OA\Response(response: ResponseAlias::HTTP_NOT_FOUND, description: 'Not found')]
    public function show(RentBlock $rentBlock): RentBlockResource
    {
        return new RentBlockResource(
            $rentBlock,
        );
    }
}
