<?php

namespace App\Http\Resources;

use App\Models\PageBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin PageBlock
 */

#[OAT\Schema(
    description: "PageBlock",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "page", ref: '#/components/schemas/PageResource'),
        new OAT\Property(property: "items", ref: '#/components/schemas/PageBlockItemResource'),
        new OAT\Property(property: "menus", ref: '#/components/schemas/MenuResource'),
    ],
)]
class PageBlockResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'page' => new PageResource($this->whenLoaded('page')),
            'menus' => MenuResource::collection($this->whenLoaded('menus')),
            $this->mergeWhen(!$request->routeIs('*.index'), [
                'items' => $this->items->mapWithKeys(function ($item) {
                    return [
                        $item->slug => new PageBlockItemResource($item),
                    ];
                }),
            ]),
        ];
    }
}
