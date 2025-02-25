<?php

namespace App\Orchid\Screens\Menu;

use App\Models\Menu;
use App\Orchid\BaseTD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MenuListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Menu $model)
    {
        self::$tableName = $model->getTable();
    }
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            self::$tableName => $this->model::query()
                ->filters()
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.menus');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.menus');
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
                BaseTD::make('id', __('general.table.name'))
                    ->sort(),
                BaseTD::make('name', __('general.table.name'))
                    ->filter(Input::make()),

                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn(Menu $menu) =>
                        Group::make([
                            Link::make(__('general.view'))
                                ->route('platform.menus.item-categories.list', [
                                    'menu' => $menu->id,
                                ])
                                ->icon('bs.eye'),
                        ])
                    ),
            ]),
        ];
    }
}
