<?php

namespace App\Http\Resources;

use App\Models\Metro;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema()
 *
 * @mixin Metro
 */
class MetroResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'time_foot' => $this->pivot?->time_foot,
            'time_car' => $this->pivot?->time_car,
        ];
    }
}
