<?php

declare(strict_types=1);

use App\Actions\RouteGeneratorAction;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuItemCategory;
use App\Orchid\Screens\Article\ArticleEditScreen;
use App\Orchid\Screens\Article\ArticleListScreen;
use App\Orchid\Screens\Article\Category\ArticleCategoryEditScreen;
use App\Orchid\Screens\Article\Category\ArticleCategoryListScreen;
use App\Orchid\Screens\ContactScreen;
use App\Orchid\Screens\MainScreen;
use App\Orchid\Screens\Menu\ItemCategory\Item\MenuItemCategoryItemEditScreen;
use App\Orchid\Screens\Menu\ItemCategory\Item\MenuItemCategoryItemListScreen;
use App\Orchid\Screens\Menu\ItemCategory\MenuItemCategoryListScreen;
use App\Orchid\Screens\Menu\MenuListScreen;
use App\Orchid\Screens\News\Category\NewsCategoryEditScreen;
use App\Orchid\Screens\News\Category\NewsCategoryListScreen;
use App\Orchid\Screens\Page\Block\Item\PageBlockItemEditScreen;
use App\Orchid\Screens\Page\Block\PageBlockEditScreen;
use App\Orchid\Screens\Page\PageEditScreen;
use App\Orchid\Screens\Page\PageScreen;
use App\Orchid\Screens\News\NewsEditScreen;
use App\Orchid\Screens\News\NewsListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\SyncHistory\SyncHistoryListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', MainScreen::class)
    ->name('platform.main');

Route::prefix('pages')->group(function () {

    //    // Platform > System > Users > User
    Route::screen('/{page}/edit', PageEditScreen::class)
        ->name('platform.pages.edit')
        ->breadcrumbs(
            fn(Trail $trail, $page) => $trail
            ->parent('platform.pages')
            ->push(__('general.edit'), route('platform.pages.edit', $page)),
        );

    // Platform > System > Users > Create
    Route::screen('/create', PageEditScreen::class)
        ->name('platform.pages.create')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.pages')
            ->push(__('general.edit'), route('platform.pages.create')),
        );

    // Platform > System > Users
    Route::screen('/', PageScreen::class)
        ->name('platform.pages')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.pages'), route('platform.pages')),
        );

    Route::prefix('{page}/blocks')->group(function () {
        Route::screen('/create', PageBlockEditScreen::class)
            ->name('platform.pages.blocks.create')
            ->breadcrumbs(
                fn(Trail $trail, $page) => $trail
                ->parent('platform.pages.edit', $page)
                ->push(__('general.create'), route('platform.pages.blocks.create', $page)),
            );

        Route::screen('{block}/edit', PageBlockEditScreen::class)
            ->name('platform.pages.blocks.edit')
            ->breadcrumbs(
                fn(Trail $trail, $page, $block) => $trail
                ->parent('platform.pages.edit', $page)
                ->push(__('general.blocks'), route('platform.pages.blocks.edit', [$page, $block])),
            );

        Route::prefix('{block}/items')->group(function () {
            Route::screen('/create', PageBlockItemEditScreen::class)
                ->name('platform.pages.blocks.items.create')
                ->breadcrumbs(
                    fn(Trail $trail, $page, $block) => $trail
                    ->parent('platform.pages.blocks.edit', $page, $block)
                    ->push(__('general.create') . ' ' . __('general.item'), route('platform.pages.blocks.items.create', [$page, $block])),
                );

            // Platform > System > Pages > {page} > Blocks > {block} > Items > {item} > Edit
            Route::screen('{blockItem}/edit', PageBlockItemEditScreen::class)
                ->name('platform.pages.blocks.items.edit')
                ->breadcrumbs(
                    fn(Trail $trail, $page, $block, $blockItem) => $trail
                    ->parent('platform.pages.blocks.edit', $page, $block)
                    ->push(__('general.edit') . ' ' . __('general.item'), route('platform.pages.blocks.items.edit', [$page, $block, $blockItem])),
                );
        });
    });
});

Route::screen('/contacts', ContactScreen::class)
    ->name('contacts.index');

Route::prefix('menus')->group(function () {
    Route::screen('', MenuListScreen::class)
        ->name('platform.menus.list')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.menus'), route('platform.menus.list')),
        );

    Route::model('menu', Menu::class);
    Route::model('category', MenuItemCategory::class);
    Route::model('item', MenuItem::class);
    Route::prefix('{menu}')->group(function () {

        Route::screen('item-categories', MenuItemCategoryListScreen::class)
            ->name('platform.menus.item-categories.list')
            ->breadcrumbs(
                fn(Trail $trail, Menu $menu) => $trail
                ->parent('platform.menus.list')
                ->push($menu->name, route('platform.menus.item-categories.list', $menu)),
            );

        Route::screen('item-categories/{category}/items', MenuItemCategoryItemListScreen::class)
            ->name('platform.menus.item-categories.items.list')
            ->breadcrumbs(
                fn(Trail $trail, Menu $menu, MenuItemCategory $category) => $trail
                ->parent('platform.menus.item-categories.list', $menu)
                ->push($category->name, route('platform.menus.item-categories.items.list', [
                    'menu' => $menu,
                    'category' => $category,
                ])),
            );

        Route::screen('item-categories/{category}/items/{item}/edit', MenuItemCategoryItemEditScreen::class)
            ->name('platform.menus.item-categories.items.edit')
            ->breadcrumbs(
                fn(Trail $trail, Menu $menu, MenuItemCategory $category, MenuItem $item) => $trail
                ->parent('platform.menus.item-categories.items.list', $menu, $category)
                ->push(__('general.edit'), route('platform.menus.item-categories.items.edit', [
                    $menu,
                    $category,
                    $item,
                ])),
            );
    });
});

Route::prefix('news')->group(function () {
    Route::screen('', NewsListScreen::class)
        ->name('platform.news.list')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.news'), route('platform.index')),
        );

    Route::screen('create', NewsEditScreen::class)
        ->name('platform.news.create')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.news'), route('platform.index')),
        );

    Route::screen('{news}/edit', NewsEditScreen::class)
        ->name('platform.news.edit')
        ->breadcrumbs(
            fn(Trail $trail, $news) => $trail
            ->parent('platform.news.list')
            ->push($news->title, route('platform.news.edit', $news)),
        );
});


Route::prefix('news-categories')->group(function () {
    Route::screen('', NewsCategoryListScreen::class)
        ->name('platform.news.categories.list')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.news_categories'), route('platform.index')),
        );

    Route::screen('create', NewsCategoryEditScreen::class)
        ->name('platform.news.categories.create')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.news.categories.list')
            ->push(__('Create'), route('platform.news.categories.create')),
        );

    Route::screen('{category}/edit', NewsCategoryEditScreen::class)
        ->name('platform.news.categories.edit')
        ->breadcrumbs(
            fn(Trail $trail, $category) => $trail
            ->parent('platform.news.categories.list')
            ->push($category->name, route('platform.news.categories.edit', $category)),
        );

});



Route::prefix('articles')->group(function () {
    Route::screen('', ArticleListScreen::class)
        ->name('platform.articles.list')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.article'), route('platform.index')),
        );

    Route::screen('create', ArticleEditScreen::class)
        ->name('platform.articles.create')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.article'), route('platform.index')),
        );

    Route::screen('{article}/edit', ArticleEditScreen::class)
        ->name('platform.articles.edit')
        ->breadcrumbs(
            fn(Trail $trail, $article) => $trail
            ->parent('platform.articles.list')
            ->push($article->title, route('platform.articles.edit', $article)),
        );
});


Route::prefix('article-categories')->group(function () {
    Route::screen('', ArticleCategoryListScreen::class)
        ->name('platform.articles.categories.list')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.index')
            ->push(__('general.category'), route('platform.index')),
        );

    Route::screen('create', ArticleCategoryEditScreen::class)
        ->name('platform.articles.categories.create')
        ->breadcrumbs(
            fn(Trail $trail) => $trail
            ->parent('platform.articles.categories.list')
            ->push(__('Create'), route('platform.articles.categories.create')),
        );

    Route::screen('{category}/edit', ArticleCategoryEditScreen::class)
        ->name('platform.articles.categories.edit')
        ->breadcrumbs(
            fn(Trail $trail, $article) => $trail
            ->parent('platform.articles.categories.list')
            ->push($article->name, route('platform.articles.categories.edit', $article)),
        );

});



// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')),
    );

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(
        fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)),
    );

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')),
    );

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')),
    );

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(
        fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)),
    );

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')),
    );

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(
        fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')),
    );

Route::screen('/sync-history', SyncHistoryListScreen::class)
    ->name('platform.sync-history.list');

RouteGeneratorAction::handle()->map(fn($item) => [
    Route::screen("/dictionaries/{$item['routeName']}", $item['screenName'])
        ->name("platform.dictionaries.{$item['routeName']}.index"),
]);
