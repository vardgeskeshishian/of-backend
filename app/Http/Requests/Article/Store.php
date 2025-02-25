<?php

namespace App\Http\Requests\Article;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Services\HTMLContentExtractor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 *
 * This class handles the validation of the user data
 * submitted for storing a new user in the system.
 *
 * @package App\Http\Requests
 * @property array $article The name of the user.
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
            'article.title'   => ['required', 'string', 'max:255'],
            'article.content' => ['required', 'string', 'max:65000'],
            'article.sources' => ['nullable', 'array'],
            'article.hyperlinks' => ['required', 'array', 'min:1'],
            'article.creator_id' => ['nullable', 'integer'],
            'article.updater_id' => ['nullable', 'integer'],
            'article.article_category_id' => [
                'required',
                Rule::exists(ArticleCategory::class, 'id'),
            ],
            'article.slug' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique(Article::class, 'slug')->ignore(
                    $this->route('article') ?? null,
                ),
            ],
        ];
    }

    /**
     * @throws \Exception
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('article.title')) {
            $extractor = new HTMLContentExtractor();
            $this->merge([
                'article' => array_merge($this->article, [
                    'slug' => Str::slug($this->article['title']),
                    'updater_id' => auth()->id(),
                    'hyperlinks' => $extractor->extractTagContent(
                        content: $this->article['content'],
                        tag: 'h1',
                    ),
                ]),
            ]);
        }

        if (!$this->route('article')) {
            $this->merge([
                'article' => array_merge($this->article, [
                    'creator_id' => auth()->id(),
                ]),
            ]);
        }
    }
}
