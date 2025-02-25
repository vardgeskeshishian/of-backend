<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;
use Orchid\Attachment\Models\Attachment;

/**
 * @mixin Attachment
 */

#[OAT\Schema(
    description: "Attachment",
    properties: [
        new OAT\Property(property: "title", type: "string"),
        new OAT\Property(property: "url", type: "string"),
        new OAT\Property(property: "mime", type: "string"),
        new OAT\Property(property: "extension", type: "string"),
    ],
)]
class AttachmentResource extends JsonResource
{
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->getTitleAttribute(),
            'url' => $this->getUrlAttribute(),
            'mime' => $this->getMimeType(),
            'extension' => $this->extension,
        ];
    }
}
