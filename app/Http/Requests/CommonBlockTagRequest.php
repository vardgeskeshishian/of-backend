<?php

namespace App\Http\Requests;

use App\Models\CommonBlock;
use App\Models\Tag;
use Illuminate\Validation\Rule;

class CommonBlockTagRequest extends BaseFormRequest
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
                'required',
                'integer',
                Rule::exists(CommonBlock::class, 'id'),
            ],
            'tag_id' => [
                'required',
                'integer',
                Rule::exists(Tag::class, 'id'),
            ],
        ];
    }
}
