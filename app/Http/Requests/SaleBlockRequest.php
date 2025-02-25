<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\Money;
use App\Models\SaleBlockTax;
use App\Models\SaleContractType;
use App\Models\TargetSalesType;
use Illuminate\Validation\Rule;

class SaleBlockRequest extends BaseFormRequest
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
            'sale_block_tax_id' => [
                'nullable',
                'integer',
                Rule::exists(SaleBlockTax::class, 'id'),
            ],
            'price_per_meter_id' => [
                'nullable',
                'integer',
                Rule::exists(Money::class, 'id'),
            ],
            'sale_contract_type_id' => [
                'nullable',
                'integer',
                Rule::exists(SaleContractType::class, 'id'),
            ],
            'target_sales_type_id' => [
                'nullable',
                'integer',
                Rule::exists(TargetSalesType::class, 'id'),
            ],
            'is_juridical_saller' => [
                'nullable',
                'integer',
                'min:-128',
                'max:127',
            ],
        ];
    }
}
