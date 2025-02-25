<?php

namespace App\Http\Resources;

use App\Http\AttachmentResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin News
 */

#[OAT\Schema(
    description: "News",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "slug", type: "string"),
        new OAT\Property(property: "likes", type: "int"),
        new OAT\Property(property: "dislikes", type: "int"),
        new OAT\Property(
            property: "hyperlinks",
            type: "array",
            items: new OAT\Items(type: "string"),
        ),
        new OAT\Property(property: "category", ref: '#/components/schemas/NewsCategoryResource'),
        new OAT\Property(property: "creator", ref: '#/components/schemas/AuthorResource'),
        new OAT\Property(property: "updater", ref: '#/components/schemas/AuthorResource'),
        new OAT\Property(property: "blocks", ref: '#/components/schemas/NewsBlockResource'),

    ],
)]
class NewsResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'likes' => $this->likes,
            'title' => $this->title,
            'dislikes' => $this->dislikes,
            'hyperlinks' => $this->hyperlinks,
            'created_at' => $this->created_at->locale('ru')
                ->isoFormat('D MMMM YYYY'),
            'updated_at' => $this->updated_at->locale('ru')
                ->isoFormat('D MMMM YYYY'),

            'category' => new NewsCategoryResource($this->category),
            'creator'  => new AuthorResource($this->creator),
            'updater'  => new AuthorResource($this->updater),
            'blocks'   => NewsBlockResource::collection(
                $this->whenLoaded('blocks'),
            ),

            $this->mergeWhen($request->routeIs('*.index'), [
                'cover' => new AttachmentResource($this->cover()),
            ]),
        ];
    }
}
