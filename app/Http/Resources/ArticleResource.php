<?php

namespace App\Http\Resources;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin Article
 */

#[OAT\Schema(
    description: "Article",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "likes", type: "int"),
        new OAT\Property(property: "dislikes", type: "int"),
        new OAT\Property(property: "slug", type: "string"),
        new OAT\Property(property: "content", type: "integer"),
        new OAT\Property(
            property: "sources",
            type: "array",
            items: new OAT\Items(
                properties: [
                    new OAT\Property(property: "link", type: "string"),
                    new OAT\Property(property: "content", type: "string"),
                ],
                type: "object",
            ),
        ),
        new OAT\Property(
            property: "hyperlinks",
            type: "array",
            items: new OAT\Items(type: "string"),
        ),
        new OAT\Property(property: "category", ref: '#/components/schemas/ArticleCategoryResource'),
        new OAT\Property(property: "creator", ref: '#/components/schemas/AuthorResource'),
        new OAT\Property(property: "updater", ref: '#/components/schemas/AuthorResource'),
    ],
)]
class ArticleResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'likes' => $this->likes,
            'title' => $this->id,
            'sources' => $this->sources,
            'content' => $this->content,
            'dislikes' => $this->dislikes,
            'hyperlinks' => $this->hyperlinks,

            'category' => new ArticleCategoryResource($this->category),
            'creator'  => new AuthorResource($this->creator),
            'updater'  => new AuthorResource($this->updater),
        ];
    }
}
