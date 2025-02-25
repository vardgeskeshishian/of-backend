<?php

namespace App\Http\Requests;

use App\Models\Building;
use App\Models\CurrencyType;
use App\Models\ParkingType;
use Illuminate\Validation\Rule;

class ParkingRequest extends BaseFormRequest
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
            'currency_id' => [
                'nullable',
                'integer',
                Rule::exists(CurrencyType::class, 'id'),
            ],
            'type_id' => [
                'nullable',
                'integer',
                Rule::exists(ParkingType::class, 'id'),
            ],
            'count' => ['required', 'integer', 'min:-2147483648', 'max:2147483647'],
            'price' => ['required', 'numeric'],
            'nds' => ['required', 'integer', 'min:-128', 'max:127'],
        ];
    }
}
