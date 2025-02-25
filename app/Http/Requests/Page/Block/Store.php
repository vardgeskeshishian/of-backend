<?php

namespace App\Http\Requests\Page\Block;

use App\Models\PageBlock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 *
 * @package App\Http\Requests
 * @property array $block.
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
            'block.page_id' => [
                'required',
                'integer',
            ],
            'block.name' => ['required', 'string', 'max:255'],
            'block.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(PageBlock::class, 'slug')->where(function ($query) {
                    return $query->where('page_id', $this->block['page_id']);
                })->ignore(
                    $this->route('block') ?? null,
                ),
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('block.name')) {
            $this->merge([
                'block' => array_merge($this->block, [
                    'slug' => Str::slug($this->block['name']),
                ]),
            ]);
        }
    }
}
