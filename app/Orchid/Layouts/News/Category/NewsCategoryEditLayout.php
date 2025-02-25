<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\News\Category;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class NewsCategoryEditLayout extends Rows
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
            Input::make('category.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
        ];
    }
}
