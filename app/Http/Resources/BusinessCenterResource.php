<?php

namespace App\Http\Resources;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @OA\Schema()
 *
 * @mixin Building
 */
class BusinessCenterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    #[OAT\Property(property: "id", type: "string")]
    #[OAT\Property(property: "name", type: "string")]
    #[OAT\Property(property: "eng_name", type: "string")]
    #[OAT\Property(property: "gross_boma_area", type: "integer")]
    #[OAT\Property(property: "gross_leasable_area", type: "integer")]

    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'eng_name' => $this->eng_name,
            'gross_boma_area' => $this->gross_boma_area,
            'gross_leasable_area' => $this->gross_leasable_area,
            'land_area' => $this->land_area,
            'floors_count' => $this->floors_count,
            'build_year' => $this->build_year,
            'address' => $this->address,
            'coordinates' => $this->coordinates,
            'freight_elevators' => $this->freight_elevators,
            'passenger_elevators' => $this->passenger_elevators,
            'taxes_department_number' => $this->taxes_department_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'parking_coefficient_is_unlimited' => $this->parking_coefficient_is_unlimited,
            'coefficient_first_value' => $this->coefficient_first_value,
            'coefficient_last_value' => $this->coefficient_last_value,
            'was_moderated' => $this->was_moderated,
            'is_export_sites' => $this->is_export_sites,
            'is_new_construction' => $this->is_new_construction,
            'is_object_cultural_heritage' => $this->is_object_cultural_heritage,
            'commissioning_year' => $this->commissioning_year,
            'commissioning_quarter' => $this->commissioning_quarter,
            'cadastral_number' => $this->cadastral_number,
            'cadastral_land_number' => $this->cadastral_land_number,
            'land_contract_date' => $this->land_contract_date,
            'district_type_id' => $this->district_type_id,
            'operating_costs_without_nds' => $this->operating_costs_without_nds,
            'year_reconstruction' => $this->year_reconstruction,
            'ensemble_name' => $this->ensemble_name,
            'built_up_area' => $this->built_up_area,
            'underground_floors_count' => $this->underground_floors_count,
            'permitted_use_of_land_plot' => $this->permitted_use_of_land_plot,

            //relations
            'metros' => MetroResource::collection($this->whenLoaded('metros')),
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'common_blocks' => CommonBlockResource::collection($this->whenLoaded('commonBlocks')),
            'administrative_district_type_id' => new AdministrativeDistrictTypeResource($this->whenLoaded('administrativeDistrictType')),
            'exterior_wall_type_id' => new ExteriorWallTypeResource($this->whenLoaded('exteriorWallType')),
            'overlap_type_id' => new OverlapTypeResource($this->whenLoaded('overlapType')),
            'law_type_id' => new LawTypeResource($this->whenLoaded('lawType')),
            'assignment_id' => new AssignmentResource($this->whenLoaded('assignment')),
            'class_code_id' => new ClassCodeResource($this->whenLoaded('classCode')),
            'provider_id' => new ProviderResource($this->whenLoaded('provider')),
            'conditioning_id' => new ConditioningResource($this->whenLoaded('conditioning')),
            'fire_alarm_id' => new FireAlarmResource($this->whenLoaded('fireAlarm')),
            'security_id' => new SecurityResource($this->whenLoaded('security')),
            'ventilation_id' => new VentilationResource($this->whenLoaded('ventilation')),
        ];
    }
}
