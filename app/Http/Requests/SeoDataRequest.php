<?php

namespace App\Http\Requests;

use App\Models\SeoData;
use Illuminate\Validation\Rule;

class SeoDataRequest extends BaseFormRequest
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
            'url' => ['nullable',
                'string',
                'min:1',
                'max:500',
                Rule::unique(SeoData::class, 'url'),
            ],
            'h1' => ['nullable', 'string', 'min:1', 'max:255'],
            'title' => ['nullable', 'string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string', 'min:1', 'max:255'],
            'keywords' => ['nullable', 'string', 'min:1', 'max:255'],
            'breadcrumbs' => ['nullable', 'string', 'min:1', 'max:255'],
            'text_top' => ['required', 'string', 'min:1', 'max:255'],
            'text_bottom' => ['required', 'string', 'min:1', 'max:255'],
        ];
    }
}
