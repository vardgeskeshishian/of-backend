<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\Image;
use Illuminate\Validation\Rule;

class CommonBlockImageRequest extends BaseFormRequest
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
                'required',
                'integer',
            ],
            'common_block_id' => [
                'required',
                'integer',
                Rule::exists(CommonBlock::class, 'id'),
            ],
            'image_id' => [
                'required',
                'integer',
                Rule::exists(Image::class, 'id'),
            ],
            'image_type' => ['nullable', 'string', 'min:1', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:-2147483648', 'max:2147483647'],
        ];
    }
}
