<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ApiDictionaryVisibleRoutes: string
{
    use EnumToArray;

    case INDEX = 'index';
    case SHOW = 'show';
}
