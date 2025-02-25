<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\News;

use App\Models\NewsCategory;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class NewsEditLayout extends Rows
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
            Relation::make('news.news_category_id')
                ->placeholder(__('general.category'))
                ->title(__('general.category'))
                ->fromModel(NewsCategory::class, 'name'),

            Input::make('news.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Matrix::make('news.sources')
                ->title(__('general.sources'))
                ->columns([
                    __('general.link') => 'link',
                    __('general.content') => 'content',
                ]),

            Quill::make('news.content')
                ->title(__('Content')),

            Upload::make('news.attachments')
                ->title(__('Attachments')),
        ];
    }
}
