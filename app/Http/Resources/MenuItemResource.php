<?php

namespace App\Http\Resources;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin MenuItem
 */

#[OAT\Schema(
    description: "MenuItem",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "value", type: "string"),
    ],
)]
class MenuItemResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
