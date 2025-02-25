<?php

namespace App\Http\Requests;

use App\Models\AdministrativeDistrictType;
use App\Models\Assignment;
use App\Models\ClassCode;
use App\Models\Conditioning;
use App\Models\DistrictType;
use App\Models\ExteriorWallType;
use App\Models\FireAlarm;
use App\Models\LawType;
use App\Models\OverlapType;
use App\Models\Provider;
use App\Models\Security;
use App\Models\User;
use App\Models\Ventilation;
use Illuminate\Validation\Rule;

class BuildingRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    #[\Override]
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    #[\Override]
    public function rules(): array
    {
        return [
            'id' => [
                'nullable',
                'integer',
            ],
            'address' => ['required', 'string', 'min:1', 'max:255'],
            'coordinates' => ['nullable', 'array'],
            'name' => ['nullable', 'string', 'min:1', 'max:255'],
            'eng_name' => ['nullable', 'string', 'min:1', 'max:255'],
            'gross_boma_area' => ['integer'],
            'gross_leasable_area' => ['integer'],
            'land_area' => ['integer'],
            'floors_count' => ['integer', 'min:-128', 'max:127'],
            'build_year' => ['nullable', 'integer', 'min:-32768', 'max:32767'],
            'freight_elevators' => ['integer', 'min:-32768', 'max:32767'],
            'passenger_elevators' => ['nullable', 'integer', 'min:-32768', 'max:32767'],
            'taxes_department_number' => ['nullable', 'string', 'min:1', 'max:255'],
            'parking_coefficient_is_unlimited' => ['boolean'],
            'coefficient_first_value' => ['nullable', 'integer', 'min:-2147483648', 'max:2147483647'],
            'coefficient_last_value' => ['nullable', 'integer', 'min:-2147483648', 'max:2147483647'],
            'was_moderated' => ['required', 'boolean'],
            'is_export_sites' => ['required', 'boolean'],
            'is_new_construction' => ['required', 'boolean'],
            'commissioning_year' => ['nullable', 'integer', 'min:-8388608', 'max:8388607'],
            'commissioning_quarter' => ['nullable', 'integer', 'min:-32768', 'max:32767'],
            'cadastral_number' => ['nullable', 'string', 'min:1', 'max:16'],
            'cadastral_land_number' => ['nullable', 'string', 'min:1', 'max:19'],
            'land_contract_date' => ['nullable', 'date'],
            'operating_costs_without_nds' => ['nullable', 'integer'],
            'year_reconstruction' => ['nullable', 'integer'],
            'is_object_cultural_heritage' => ['boolean'],
            'ensemble_name' => ['nullable', 'string', 'max:255'],
            'built_up_area' => ['nullable', 'integer'],
            'underground_floors_count' => ['nullable', 'integer'],
            'permitted_use_of_land_plot' => ['nullable', 'string'],
            'security_id' => [
                'nullable',
                'integer',
                Rule::exists(Security::class, 'id'),
            ],
            'ventilation_id' => [
                'nullable',
                'integer',
                Rule::exists(Ventilation::class, 'id'),
            ],
            'fire_alarm_id' => [
                'nullable',
                'integer',
                Rule::exists(FireAlarm::class, 'id'),
            ],
            'assignment_id' => [
                'nullable',
                'integer',
                Rule::exists(Assignment::class, 'id'),
            ],
            'conditioning_id' => [
                'nullable',
                'integer',
                Rule::exists(Conditioning::class, 'id'),
            ],
            'district_type_id' => [
                'nullable',
                'integer',
                Rule::exists(DistrictType::class, 'id'),
            ],
            'class_code_id' => [
                'nullable',
                'integer',
                Rule::exists(ClassCode::class, 'id'),
            ],
            'provider_id' => [
                'nullable',
                'integer',
                Rule::exists(Provider::class, 'id'),
            ],
            'administrative_district_type_id' => [
                'nullable',
                'integer',
                Rule::exists(AdministrativeDistrictType::class, 'id'),
            ],
            'exterior_wall_type_id' => [
                'nullable',
                'integer',
                Rule::exists(ExteriorWallType::class, 'id'),
            ],
            'overlap_type_id' => [
                'nullable',
                'integer',
                Rule::exists(OverlapType::class, 'id'),
            ],
            'law_type_id' => [
                'nullable',
                'integer',
                Rule::exists(LawType::class, 'id'),
            ],
        ];
    }
}
