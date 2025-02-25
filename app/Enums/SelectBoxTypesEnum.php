<?php

namespace App\Enums;

use App\Traits\EnumToArray;
use OpenApi\Attributes as OAT;

#[OAT\Schema(type: 'string')]
enum SelectBoxTypesEnum: string
{
    use EnumToArray;

    case METROS = 'metros';

    case DISTRICT_TYPES = 'district_types';

    case ASSIGNMENTS = 'assignments';

    case ADMINISTRATIVE_DISTRICT_TYPES = 'administrative_district_types';

    case AGREEMENT_TYPES  = 'agreement_types';

    case INFRASTRUCTURE_TYPES = 'infrastructure_types';

    case OFFICE_LAYOUT_TYPES = 'office_layout_types';

    case OFFICE_READYNESS_TYPES = 'office_readyness_types';

    case OVERLAP_TYPES = 'overlap_types';

}
