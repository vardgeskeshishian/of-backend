<?php

namespace App\Orchid;

use Orchid\Screen\TD;

/**
 * @method TD|BaseTD bool()
 */
class BaseTD extends TD
{
    public function getColumn(): string
    {
        return $this->column;
    }
}
