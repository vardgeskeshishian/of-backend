<?php

namespace App\Orchid\Listeners\News;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class NewsEditFormListener extends Listener
{
    protected $targets = [
        'counter',
    ];

    public string $type = 'social';

    /**
     * @return iterable
     */
    protected function layouts(): iterable
    {

        return [
            Layout::rows([
                Relation::make('news.news_category_id')
                    ->placeholder(__('general.category'))
                    ->title(__('general.category') . $this->query->get('counter'))
                    ->fromModel(NewsCategory::class, 'name'),

                Input::make('news.title')
                    ->type('text')
                    ->max(255)
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Matrix::make('news.sources')
                    ->title(__('general.sources'))
                    ->columns([
                        __('general.link') => 'link',
                        __('general.content') => 'content',
                    ]),

                SimpleMDE::make('news.content')
                    ->title(__('Content')),

                Upload::make('news.attachments')
                    ->title(__('Attachments')),
            ]),
        ];
    }

    /**
     * @param Repository $repository
     * @param Request $request
     * @return Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        $this->type = $request->input('item.type', 'social');
        return $repository
            ->set('item.type', $request->input('item.type'))
            ->set('item.name', $request->input('item.name'));
    }
}
