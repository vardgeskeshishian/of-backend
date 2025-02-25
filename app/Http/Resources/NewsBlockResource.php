<?php

namespace App\Http\Resources;

use App\Enums\BuilderBlockTypes;
use App\Http\AttachmentResource;
use App\Models\NewsBlock;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @mixin NewsBlock
 */

#[OAT\Schema(
    description: "NewsBlocks",
    properties: [
        new OAT\Property(property: "id", type: "int"),
        new OAT\Property(property: "type", type: "string"),
        new OAT\Property(property: "sorting", type: "int"),
        new OAT\Property(
            property: "content",
            oneOf: [
                new OAT\Schema(type: "string"),
                new OAT\Schema(
                    type: "array",
                    items: new OAT\Items(
                        type: "string",
                    ),
                ),
            ],
        ),
        new OAT\Property(property: "media", ref: '#/components/schemas/AttachmentResource'),
    ],
)]
class NewsBlockResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'type' => $this->type,
            'sorting' => $this->sorting,
            'content' => $this->content,
            $this->mergeWhen(in_array($this->type, [BuilderBlockTypes::IMAGE->value, BuilderBlockTypes::VIDEO->value, BuilderBlockTypes::QUOTES->value]), [
                'media' => AttachmentResource::collection($this->attachments),
            ]),
        ];
    }
}
