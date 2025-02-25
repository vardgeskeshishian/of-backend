<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\ContractTermType;
use App\Models\Money;
use App\Models\RentBlockTax;
use App\Models\RentContractType;
use App\Models\UtilityCostsType;
use Illuminate\Validation\Rule;

class RentBlockRequest extends BaseFormRequest
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
            'common_block_id' => [
                'nullable',
                'integer',
                Rule::exists(CommonBlock::class, 'id'),
            ],
            'is_coworking' => ['boolean'],
            'price_meter_year_id' => [
                'nullable',
                'integer',
                Rule::exists(Money::class, 'id'),
            ],
            'operational_cost_id' => [
                'nullable',
                'integer',
                Rule::exists(Money::class, 'id'),
            ],
            'rent_block_tax_id' => [
                'nullable',
                'integer',
                Rule::exists(RentBlockTax::class, 'id'),
            ],
            'rent_contract_type_id' => [
                'nullable',
                'integer',
                Rule::exists(RentContractType::class, 'id'),
            ],
            'utility_costs_type_id' => [
                'nullable',
                'integer',
                Rule::exists(UtilityCostsType::class, 'id'),
            ],
            'contract_term_type_id' => [
                'nullable',
                'integer',
                Rule::exists(ContractTermType::class, 'id'),
            ],
            'deposit' => ['integer', 'min:-8388608', 'max:8388607'],
        ];
    }
}
