<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Page\Block\Item;

use App\Models\PageBlockItem;
use App\Orchid\BaseTD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PageBlockItemTableLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'page_block_items';

    /**
     * @return TD[]
     */
    #[\Override]
    public function columns(): array
    {
        return [
            BaseTD::make('id', __('ID'))
                ->sort()
                ->cantHide(),

            BaseTD::make('name', __('Name'))
                ->sort()
                ->cantHide(),

            BaseTD::make('image_id', __('general.table.image'))
                ->render(fn(PageBlockItem $model) => view('orchid.components.image', [
                    'url' => $model->attachment?->url,
                ])),

            BaseTD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            BaseTD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('120px')
                ->render(
                    fn(PageBlockItem $blockItem) =>
                    Group::make([
                        Link::make()
                            ->route('platform.pages.blocks.items.edit', [
                                'page' => $blockItem->block->page->id,
                                'block' => $blockItem->block->id,
                                'blockItem' => $blockItem->id,
                            ])
                            ->icon('bs.pencil-square'),

                        Button::make()
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted.'))
                            ->method('remove', [
                                'blockItem' => $blockItem->id,
                            ]),
                    ]),
                ),
        ];
    }
}
