<?php

namespace App\Http\Resources;

use App\Models\BlockForVacation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin BlockForVacation */
class BlockForVacationResource extends JsonResource
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
            'common_block' => new CommonBlockResource(
                $this->whenLoaded('commonBlock'),
            ),
            'date' => $this->date->toDateString(),
            'period_vacation_type' => new PeriodVacationTypeResource(
                $this->whenLoaded('periodVacationType'),
            ),
        ];
    }
}
