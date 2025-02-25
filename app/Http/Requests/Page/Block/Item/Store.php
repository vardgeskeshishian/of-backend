<?php

namespace App\Http\Requests\Page\Block\Item;

use App\Models\PageBlockItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @package App\Http\Requests
 * @property array $item The name of the user.
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
            'item.name' => ['required', 'string', 'max:255'],
            'item.title' => ['nullable', 'string', 'max:255'],
            'item.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(PageBlockItem::class, 'slug')->where(function ($query) {
                    return $query->where('page_block_id', $this->item['page_block_id']);
                })->ignore(
                    $this->route('blockItem') ?? null,
                ),
            ],
            'item.type' => ['nullable', 'string', 'max:255'],
            'item.link' => ['nullable', 'string', 'max:255'],
            'item.text' => ['nullable', 'string', 'max:65000'],
            'item.list' => ['nullable', 'array'],
            'item.attachment_id' => ['nullable'],

        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('item.name')) {
            $this->merge([
                'item' => array_merge($this->item, [
                    'slug' => Str::slug($this->item['name'], '_'),
                ]),
            ]);
        }
    }
}
