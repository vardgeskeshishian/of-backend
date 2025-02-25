<?php

declare(strict_types=1);

namespace App\Orchid\Fields;

use Orchid\Screen\Action;
use Orchid\Screen\Concerns\Multipliable;

class ClipboardInput extends Action
{
    use Multipliable;

    /**
     * Blade template
     *
     * @var string
     */
    protected $view = 'orchid.fields.clipboard';


    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'method'     => null,
        'icon'       => null,
        'action'     => null,
        'confirm'    => null,
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'value',
    ];
}
