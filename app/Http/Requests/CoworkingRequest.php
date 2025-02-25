<?php

namespace App\Http\Requests;

use App\Models\CoworkingOperatorType;
use App\Models\RentBlock;
use Illuminate\Validation\Rule;

class CoworkingRequest extends BaseFormRequest
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
            'rent_block_id' => [
                'nullable',
                'integer',
                Rule::exists(RentBlock::class, 'id'),
            ],
            'coworking_operator_type_id' => [
                'nullable',
                'integer',
                Rule::exists(CoworkingOperatorType::class, 'id'),
            ],
            'working_place_count' => ['integer', 'min:-32768', 'max:32767'],
            'free_place_count' => ['integer', 'min:-32768', 'max:32767'],
        ];
    }
}
