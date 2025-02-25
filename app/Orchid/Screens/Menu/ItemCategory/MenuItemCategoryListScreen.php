<?php

namespace App\Orchid\Screens\Menu\ItemCategory;

use App\Models\Menu;
use App\Models\MenuItemCategory;
use App\Orchid\BaseTD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MenuItemCategoryListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public MenuItemCategory $model)
    {
        self::$tableName = $model->getTable();
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Menu $menu, MenuItemCategory $category): iterable
    {
        return [
            self::$tableName => $menu->categories()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.item_categories');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.item_categories');
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
                    ->render(fn(MenuItemCategory $category) => e($category->menu->name)),
                BaseTD::make('name', __('general.table.name'))
                    ->filter(Input::make()),
                BaseTD::make('key', __('general.table.key'))
                    ->filter(Input::make()),
                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn(MenuItemCategory $category) =>
                    Group::make([
                        Link::make(__('general.view'))
                            ->route('platform.menus.item-categories.items.list', [
                                'menu' => $category->menu->id,
                                'category' => $category->id,
                            ])
                            ->icon('bs.eye'),
                        ])
                    ),
            ]),
        ];
    }
}
