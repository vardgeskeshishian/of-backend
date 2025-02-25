<?php

namespace App\Orchid\Screens\Menu\ItemCategory\Item;

use App\Http\Requests\Menu\ItemCategory\Item\Store;
use App\Models\MenuItem;
use App\Orchid\Layouts\Menu\Category\Item\MenuItemEditLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class MenuItemCategoryItemEditScreen extends Screen
{
    public $item;

    public function query(MenuItem $item): iterable
    {
        return [
            'item' => $item,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.item');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.item');
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
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
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
            MenuItemEditLayout::class,
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(Store $request, MenuItem $item): RedirectResponse
    {
        $item->fill($request->get('item'));

        $item->save();

        Toast::info(__('Item was saved'));

        return to_route('platform.menus.item-categories.items.list', [
            'menu' => $item->category->menu->id,
            'category' => $item->category->id,
        ]);
    }
}
