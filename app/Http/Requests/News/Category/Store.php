<?php

namespace App\Http\Requests\News\Category;

use App\Models\NewsCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest
 *
 * This class handles the validation of the user data
 * submitted for storing a new user in the system.
 *
 * @package App\Http\Requests
 * @property array $category The name of the user.
 */
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
            'category.name'   => ['required', 'string', 'max:255'],
            'category.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(NewsCategory::class, 'slug')->ignore(
                    $this->route('category') ?? null,
                ),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('category.name')) {
            $this->merge([
                'category' => array_merge($this->category, [
                    'slug' => Str::slug($this->category['name']),
                ]),
            ]);
        }
    }
}
