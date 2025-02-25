<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\PeriodVacationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlockForVacationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'min:0', 'max:18446744073709551615'],
            'common_block_id' => [
                'required',
                Rule::exists(CommonBlock::class, 'id'),
            ],
            'date' => ['nullable', 'date'],
            'period_vacation_type_id' => [
                'nullable',
                Rule::exists(PeriodVacationType::class, 'id'),
            ],
        ];
    }
}
