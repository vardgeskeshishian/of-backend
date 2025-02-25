<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Page;

use App\Models\Page;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'pages';

    /**
     * @return TD[]
     */
    #[\Override]
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))
                ->sort()
                ->cantHide(),

            TD::make('name', __('Name'))
                ->sort()
                ->cantHide(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('120px')
                ->render(fn(Page $page) =>
                    Group::make([
                        Link::make()
                            ->route('platform.pages.edit', $page->id)
                            ->icon('bs.pencil-square'),
                        Button::make()
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted.'))
                            ->method('remove', [
                                'id' => $page->id,
                            ]),
                    ]),
                ),
        ];
    }
}
