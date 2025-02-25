<?php

namespace App\Orchid\Screens\Menu\ItemCategory\Item;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemCategory;
use App\Orchid\BaseTD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MenuItemCategoryItemListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public MenuItem $model)
    {
        self::$tableName = $model->getTable();
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Menu $menu, MenuItemCategory $category, MenuItem $item): iterable
    {
        return [
            self::$tableName => $category->items()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.items');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.items');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    #[\Override]
    public function commandBar(): iterable
    {
        return [
            //
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('id', __('general.table.id'))
                    ->sort(),
                BaseTD::make('creator_id', __('general.table.category'))
                    ->render(fn(MenuItem $item) => e($item->category->name)),
                BaseTD::make('name', __('general.table.name'))
                    ->filter(Input::make()),
                BaseTD::make('value', __('general.table.value'))
                    ->filter(Input::make()),
                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn(MenuItem $item) =>
                    Group::make([
                        Link::make(__('Edit'))
                            ->route('platform.menus.item-categories.items.edit', [
                                'menu' => $item->category->menu->id,
                                'category' => $item->category->id,
                                'item' => $item->id,
                            ])
                            ->icon('bs.pencil'),
                    ])),
            ]),
        ];
    }
}
