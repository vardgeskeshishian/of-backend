<?php

namespace App\Orchid\Layouts\Page\Block;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class PageBlockEditLayout extends Rows
{
    public function fields(): iterable
    {
        return [
            Input::make('block.page_id')
                ->value($this->query->get('page.id'))
                ->hidden(),

            Input::make('block.name')
                ->placeholder('Block name'),
        ];
    }
}
