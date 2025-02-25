<?php

namespace App\Http\Requests;

use App\Models\CurrencyType;
use Illuminate\Validation\Rule;

class MoneyRequest extends BaseFormRequest
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
            'value' => ['numeric'],
            'currency_type_id' => [
                'required',
                'integer',
                Rule::exists(CurrencyType::class, 'id'),
            ],
        ];
    }
}
