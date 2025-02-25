<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemCategory;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/* * * * * * * * * * * * * * * * * * * * * */
/* php artisan db:seed --class=MenuSeeder  */
/* * * * * * * * * * * * * * * * * * * * * */

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private static array $menu = [
        [
            'name' => 'Аренда',
            'categories' => [
                [
                    'name' => 'По округам',
                    'key' => 'district',
                    'items' => ['САО', 'СВАО', 'ЦАО', 'ЮАО', 'ЗАО', 'ВАО', 'ЮЗАО', 'СЗАО', 'ЮВАО'],
                ],
                [
                    'name' => 'По метро',
                    'key' => 'metro',
                    'items' => ['Строгино', 'Некрасовка', 'Белорусский', 'Сокол', 'Павелецкий', 'Марьино', 'Ясенево'],
                ],
                [
                    'name' => 'По особенностям',
                    'key' => 'specific',
                    'items' => ['С мебелью', 'С отдельным входом', 'С кабинетной планировкой'],
                ],
                [
                    'name' => 'По метражу',
                    'key' => 'meter',
                    'items' => ['100 м²', '150 м²', '200 м²', '300 м²', '400 м²', '500 м²', '1000 м²', '3000 м²'],
                ],
                [
                    'name' => 'По улице',
                    'key' => 'street',
                    'items' => ['Ленинский проспект', 'Профсоюзная улица', 'Шоссе Энтузиастов', 'Варшавское шоссе', 'Тверской бульвар', 'Волгоградский проспект', 'Улица Арбат'],
                ],
                [
                    'name' => 'По району',
                    'key' => 'area',
                    'items' => ['Москва-сити', 'Митино', 'Дмитровский', 'Южное Бутово', 'Нижегородский', 'Солнцево', 'Отрадное', 'Северное Бутово'],
                ],
            ],
        ],
        [
            'name' => 'Services',
            'categories' => [],
        ],
        [
            'name' => 'Аренда',
            'categories' => [
                [
                    'name' => 'Все',
                    'key' => 'all',
                    'items' => [
                        'Аренда офиса в Москве',
                        'Бизнес-центры Москвы',
                        'Офисы в Москва-Сити',
                        'Аренда особняка',
                        'Аренда здания',
                    ],
                ],
            ],
        ],
        [
            'name' => 'Продажа',
            'categories' => [
                [
                    'name' => 'Все',
                    'key' => 'all',
                    'items' => [
                        'Продажа офиса в Москве',
                        'Продажа особняка',
                        'Продажа здания',
                    ],
                ],
            ],
        ],
        [
            'name' => 'Услуги',
            'categories' => [
                [
                    'name' => 'Все',
                    'key' => 'all',
                    'items' => [
                        'Арендаторам',
                        'Покупателям',
                        'Инвесторам',
                    ],
                ],
            ],
        ],
        [
            'name' => 'Поиск',
            'categories' => [
                [
                    'name' => 'Все',
                    'key' => 'all',
                    'items' => [
                        'Поиск по районам',
                        'Поиск по улицам Москвы',
                        'Поиск по метро',
                    ],
                ],
            ],
        ],
        [
            'name' => 'Компания',
            'categories' => [
                [
                    'name' => 'Все',
                    'key' => 'all',
                    'items' => [
                        'О компании',
                        'Контакты',
                        'Новости',
                        'Карьера',
                        'Партнерам',
                    ],
                ],
            ],
        ],
    ];

    /**
     * @throws Exception
     */
    public function run(): void
    {
        try{

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                MenuItem::query()->truncate();
                MenuItemCategory::query()->truncate();
                Menu::query()->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            foreach (self::$menu as $menuData) {
                $menu = Menu::create(['name' => $menuData['name']]);

                if (!empty($menuData['categories'])) {
                    foreach ($menuData['categories'] as $categoryData) {
                        $category = MenuItemCategory::create([
                            'menu_id' => $menu->id,
                            'name' => $categoryData['name'],
                            'key' => $categoryData['key'],
                        ]);

                        foreach ($categoryData['items'] as $itemName) {
                            MenuItem::create([
                                'menu_item_category_id' => $category->id,
                                'name' => $itemName,
                                'value' => Str::slug($itemName),
                            ]);
                        }
                    }
                }
            }
        }catch(Exception $e){

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            Log::error('Menu seeder failed: ' . $e->getMessage());

            throw $e;
        }
    }
}
