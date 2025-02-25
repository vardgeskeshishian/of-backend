<?php

namespace App\Http\Resources;

use OpenApi\Attributes as OAT;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */

#[OAT\Schema(
    description: "Author",
    properties: [
        new OAT\Property(property: 'name', type: 'string'),
        new OAT\Property(property: 'avatar', type: 'string'),
    ],
)]
class AuthorResource extends JsonResource
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
            'avatar' => $this->avatar,
        ];
    }
}
