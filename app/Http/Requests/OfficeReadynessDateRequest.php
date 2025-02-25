<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use Illuminate\Validation\Rule;

class OfficeReadynessDateRequest extends BaseFormRequest
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
            'date' => ['required', 'date'],
        ];
    }
}
