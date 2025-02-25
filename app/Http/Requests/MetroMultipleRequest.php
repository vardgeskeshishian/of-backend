<?php

namespace App\Http\Requests;

use App\Models\Metro;
use App\Models\MetroMultipleTypes;
use Illuminate\Validation\Rule;

class MetroMultipleRequest extends BaseFormRequest
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
            'metro_multiple_types_id' => [
                'required',
                'integer',
                Rule::exists(MetroMultipleTypes::class, 'id'),
            ],
            'metro_id' => [
                'required',
                'integer',
                Rule::exists(Metro::class, 'id'),
            ],
        ];
    }
}
