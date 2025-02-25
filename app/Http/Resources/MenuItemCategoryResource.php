<?php

namespace App\Http\Resources;

use App\Models\MenuItemCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin MenuItemCategory
 */

#[OAT\Schema(
    description: "MenuItemCategory",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "key", type: "string"),
        new OAT\Property(property: "items", ref: '#/components/schemas/MenuItemResource'),
    ],
)]
class MenuItemCategoryResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'key' => $this->key,
            'items' => MenuItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
