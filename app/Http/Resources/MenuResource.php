<?php

namespace App\Http\Resources;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin Menu
 */

#[OAT\Schema(
    description: "Menus",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "categories", ref: '#/components/schemas/MenuItemCategoryResource'),
    ],
)]
class MenuResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categories' => MenuItemCategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
