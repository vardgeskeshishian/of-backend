<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Article;

use App\Models\ArticleCategory;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ArticleEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    #[\Override]
    public function fields(): array
    {
        return [
            Relation::make('article.article_category_id')
                ->placeholder(__('general.category'))
                ->title(__('general.category'))
                ->fromModel(ArticleCategory::class, 'name'),

            Input::make('article.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Matrix::make('article.sources')
                ->title(__('general.sources'))
                ->columns([
                    __('general.link') => 'link',
                    __('general.content') => 'content',
                ]),

            Quill::make('article.content')
                ->title(__('Content')),

            Upload::make('article.attachments')
                ->title(__('Attachments')),
        ];
    }
}
