<?php

namespace App\Http\Requests\Page;

use App\Models\Page;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Store extends FormRequest
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
            'page.name' => ['required', 'string', 'max:255'],
            'page.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(Page::class, 'slug')->ignore(
                    $this->route('page') ?? null,
                ),
            ],
        ];
    }
}
