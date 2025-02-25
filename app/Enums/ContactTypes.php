<?php

namespace App\Enums;

use App\Traits\EnumToArray;
use OpenApi\Attributes as OAT;

#[OAT\Schema(type: 'string')]
enum ContactTypes: string
{
    use EnumToArray;

    case APPLICATION = 'application';

    case HELP = 'help';

    case PRESENTATION = 'presentation';

    case QUESTION = 'question';

    case LAYOUT = 'layout';

}
