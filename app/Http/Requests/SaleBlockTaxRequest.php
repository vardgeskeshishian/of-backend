<?php

namespace App\Http\Requests;

use App\Models\TaxType;
use Illuminate\Validation\Rule;

class SaleBlockTaxRequest extends BaseFormRequest
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
            'tax_type_id' => [
                'nullable',
                'integer',
                Rule::exists(TaxType::class, 'id'),
            ],
        ];
    }
}
