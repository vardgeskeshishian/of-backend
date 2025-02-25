<?php

namespace App\Enums;

use App\Traits\EnumToArray;
use OpenApi\Attributes as OAT;

#[OAT\Schema(type: 'string')]
enum AssignmentsEnum: string
{
    use EnumToArray;

    case RESIDENTIAL_BUILDING = 'Жилой дом';
    case DETACHED_BUILDING = 'Отдельностоящее здание';
    case BUSINESS_CENTER = 'Бизнес-центр';
    case BUSINESS_PARK = 'Бизнес-парк';
    case SHOPPING_CENTER = 'Торговый центр';
    case ADMINISTRATIVE_BUILDING = 'Административное здание';
    case MANSION = 'Особняк';
    case RESIDENTIAL_COMPLEX = 'Жилой комплекс';
    case COMMERCIAL_OFFICE_COMPLEX = 'Торгово-офисный комплекс';
    case MULTIFUNCTIONAL_COMPLEX = 'Многофункциональный комплекс';
    case OFFICE_RESIDENTIAL_COMPLEX = 'Офисно-жилой комплекс';
    case OFFICE_BUILDING_COMPLEX = 'Комплекс офисных зданий';
    case OFFICE_WAREHOUSE_COMPLEX = 'Офисно-складской комплекс';
    case ADDITION_TO_RESIDENTIAL_BUILDING = 'Пристройка к жилому дому';
    case HANGAR = 'Ангар';
    case GARAGE = 'Гараж';
    case GARAGE_COMPLEX = 'Гаражный комплекс';
    case HOTEL = 'Гостиница';
    case PROPERTY_COMPLEX = 'Имущественный комплекс';
    case MANSION_COMPLEX = 'Комплекс особняков';
    case MULTI_APARTMENT_BUILDING = 'Многоквартирный дом';
    case HOTEL_BUILDING = 'Отель';
    case HOTEL_OFFICE_COMPLEX = 'Офисно-гостиничный комплекс';
    case PRODUCTION_BUILDING = 'Производственный корпус';
    case PRODUCTION_COMPLEX = 'Производственный комплекс';
    case PRODUCTION_WAREHOUSE_COMPLEX = 'Производствено-складской комплекс';
    case WAREHOUSE = 'Склад';
    case WAREHOUSE_COMPLEX = 'Складской комплекс';
    case SPORTS_COMPLEX = 'Спортивный комплекс';
    case PHYSICAL_CULTURE_COMPLEX = 'Физкультурно-оздоровительный комплекс';
}
