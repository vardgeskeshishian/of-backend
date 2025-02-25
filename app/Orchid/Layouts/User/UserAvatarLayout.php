<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class UserAvatarLayout extends Rows
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
            Picture::make('user.avatar')
                ->title(__('general.user_avatar')),
        ];
    }
}
