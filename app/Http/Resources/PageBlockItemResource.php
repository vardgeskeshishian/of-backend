<?php

namespace App\Http\Resources;

use App\Http\AttachmentResource;
use App\Models\PageBlockItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin PageBlockItem
 */

#[OAT\Schema(
    description: "PageBlockItem",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "name", type: "string"),
        new OAT\Property(property: "type", type: "string"),
        new OAT\Property(property: "link", type: "string"),
        new OAT\Property(property: "text", type: "string"),
        new OAT\Property(
            property: "list",
            type: "array",
            items: new OAT\Items(
                properties: [
                    new OAT\Property(property: "value", type: "string"),
                    new OAT\Property(property: "additional", type: "string"),
                    new OAT\Property(property: "mark", type: "string"),
                ],
                type: "object",
            ),
        ),
        new OAT\Property(property: "page", ref: '#/components/schemas/PageResource'),
        new OAT\Property(property: "attachment", ref: '#/components/schemas/AttachmentResource'),
    ],
)]
class PageBlockItemResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'type' => $this->type,
            'link' => $this->link,
            'text' => $this->text,
            'list' => $this->list,
            'attachment' => new AttachmentResource($this->attachment),
        ];
    }
}
