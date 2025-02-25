<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Orchid\Fields\ClipboardInput;
use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;

class UserTokenLayout extends Rows
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
            ClipboardInput::make('user.api_token'),
        ];
    }
}
