<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\FloorType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommonBlockFloorTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'common_block_id' => [
                'required',
                'integer',
                Rule::exists(CommonBlock::class, 'id'),
            ],
            'floor_type_id' => [
                'required',
                'integer',
                Rule::exists(FloorType::class, 'id'),
            ],
        ];
    }
}
