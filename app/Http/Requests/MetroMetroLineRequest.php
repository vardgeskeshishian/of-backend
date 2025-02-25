<?php

namespace App\Http\Requests;

use App\Models\Metro;
use App\Models\MetroLine;
use Illuminate\Validation\Rule;

class MetroMetroLineRequest extends BaseFormRequest
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
            'metro_id' => [
                'nullable',
                'integer',
                Rule::exists(Metro::class, 'id'),
            ],
            'metro_line_id' => [
                'nullable',
                'integer',
                Rule::exists(MetroLine::class, 'id'),
            ],
        ];
    }
}
