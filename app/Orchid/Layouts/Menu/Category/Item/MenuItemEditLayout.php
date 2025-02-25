<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Menu\Category\Item;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MenuItemEditLayout extends Rows
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
            Input::make('item.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),

            Input::make('item.value')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Value'))
                ->placeholder(__('Value')),
        ];
    }
}
