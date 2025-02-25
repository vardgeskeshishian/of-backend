<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\InternetProviderType;
use Illuminate\Validation\Rule;

class BuildingInternetProviderTypeRequest extends BaseFormRequest
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
                'required',
                'integer',
                Rule::exists(Building::class, 'id'),
            ],
            'internet_provider_type_id' => [
                'required',
                'integer',
                Rule::exists(InternetProviderType::class, 'id'),
            ],
        ];
    }
}
