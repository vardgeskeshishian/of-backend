<?php

namespace App\Http\Resources;

use OpenApi\Attributes as OAT;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin NewsCategory
 */

#[OAT\Schema(
    description: "NewsCategory",
    properties: [
        new OAT\Property(property: 'name', type: 'string'),
        new OAT\Property(property: 'slug', type: 'string'),
    ],
)]
class NewsCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }
}
