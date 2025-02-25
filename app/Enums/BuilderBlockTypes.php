<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum BuilderBlockTypes: string
{
    use EnumToArray;

    case EDITOR = 'editor';
    case IMAGE = 'image';

    case VIDEO = 'video';

    case TEXTAREA = 'textarea';

    case SOURCES = 'sources';

    case INFO = 'info';

    case QUOTES = 'quotes';
}
