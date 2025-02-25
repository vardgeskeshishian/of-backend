<?php

namespace App\Http\Resources;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin Page
 */

#[OAT\Schema(
    description: "Pages",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "slug", type: "string"),
        new OAT\Property(property: "blocks", ref: '#/components/schemas/PageBlockResource'),
    ],
)]
class PageResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'blocks' => PageBlockResource::collection($this->whenLoaded('blocks')),
        ];
    }
}
