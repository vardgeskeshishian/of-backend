<?php

namespace App\Http\Resources;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin ArticleCategory
 */

#[OAT\Schema(
    description: "ArticleCategory",
    properties: [
        new OAT\Property(property: 'name', type: 'string'),
        new OAT\Property(property: 'slug', type: 'string'),
    ],
)]
class ArticleCategoryResource extends JsonResource
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
