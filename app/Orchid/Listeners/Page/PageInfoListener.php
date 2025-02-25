<?php

namespace App\Orchid\Listeners\Page;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;

class PageInfoListener extends Listener
{
    protected $targets = [
        'page.name',
    ];

    /**
     * @return iterable
     */
    protected function layouts(): iterable
    {
        return [
            Layout::rows([
                Input::make('page.name')
                    ->type('text')
                    ->max(255)
                    ->required()
                    ->title(__('Name'))
                    ->placeholder(__('Name')),

                Input::make('page.slug')
                    ->type('text')
                    ->title(__('Slug'))
                    ->placeholder(__('Slug')),
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
        return $repository
            ->set('page.name', $request->input('page.name'))
            ->set('page.slug', Str::slug($request->input('page.name')));
    }
}
