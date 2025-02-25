<?php

namespace App\Http\Requests\News;

use App\Models\News;
use App\Models\NewsCategory;
use App\Services\HTMLContentExtractor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Class StoreUserRequest
 *
 * This class handles the validation of the user data
 * submitted for storing a new user in the system.
 *
 * @package App\Http\Requests
 * @property array $news The name of the user.
 * @property array $blocks The name of the block.
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
            'blocks' => ['nullable', 'array'],
            'news.creator_id' => ['nullable', 'integer'],
            'news.updater_id' => ['nullable', 'integer'],
            'news.news_category_id' => [
                'required',
                Rule::exists(NewsCategory::class, 'id'),
            ],
            'news.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(News::class, 'slug')->ignore(
                    $this->route('news') ?? null,
                ),
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('news.title')) {
            $extractor = new HTMLContentExtractor();
            $contents = Arr::pluck($this->blocks ?? [], 'content');
            $contents = Arr::where($contents, function ($value) {
                return is_string($value);
            });
            $this->merge([
                'news' => array_merge($this->news, [
                    'slug' => Str::slug($this->news['title']),
                    'updater_id' => auth()->id(),
                    'hyperlinks' => $extractor->extractTagContents(
                        contents: $contents,
                        tag: 'h1',
                    ),
                ]),
            ]);
        }

        if (!$this->route('news')) {
            $this->merge([
                'news' => array_merge($this->news, [
                    'creator_id' => auth()->id(),
                ]),
            ]);
        }
    }
}
