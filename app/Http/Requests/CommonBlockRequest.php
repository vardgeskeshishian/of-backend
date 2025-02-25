<?php

namespace App\Http\Requests;

use App\Models\BlockType;
use App\Models\Building;
use App\Models\Money;
use App\Models\OfficeLayoutType;
use App\Models\OfficeReadynessType;
use Illuminate\Validation\Rule;

class CommonBlockRequest extends BaseFormRequest
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
            'building_id' => [
                'nullable',
                'integer',
                Rule::exists(Building::class, 'id'),
            ],
            'name' => ['nullable', 'string', 'min:1', 'max:255'],
            'is_available' => ['boolean'],
            'is_negotiable_price' => ['boolean'],
            'commission_amount_percent' => ['required', 'numeric'],
            'is_export_sites' => ['boolean'],
            'is_export_markets' => ['boolean'],
            'is_full_building' => ['boolean'],
            'is_floor_range' => ['boolean'],
            'owner_id' => ['nullable', 'integer', 'min:0', 'max:18446744073709551615'],
            'min_area' => ['integer', 'min:-8388608', 'max:8388607'],
            'max_area' => ['integer', 'min:-8388608', 'max:8388607'],
            'useful_area' => ['integer', 'min:-8388608', 'max:8388607'],
            'electric_power' => ['integer', 'min:-8388608', 'max:8388607'],
            'max_parking_size' => ['integer', 'min:-32768', 'max:32767'],
            'is_for_vacation' => ['boolean'],
            'block_type_id' => [
                'nullable',
                'integer',
                Rule::exists(BlockType::class, 'id'),
            ],
            'office_layout_type_id' => [
                'nullable',
                'integer',
                Rule::exists(OfficeLayoutType::class, 'id'),
            ],
            'office_readyness_type_id' => [
                'nullable',
                'integer',
                Rule::exists(OfficeReadynessType::class, 'id'),
            ],
            'is_street_entrance' => ['nullable', 'boolean'],
            'is_separate_entrance' => ['boolean'],
            'is_furnished' => ['boolean'],
            'inner_text' => ['nullable', 'string', 'min:1'],
            'site_text' => ['nullable', 'string', 'min:1'],
            'presentation_description' => ['nullable', 'string', 'min:1'],
        ];
    }
}
