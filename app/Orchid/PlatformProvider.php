<?php

declare(strict_types=1);

namespace App\Orchid;

use App\Actions\GetTableNameAndCommentAction;
use App\Actions\RouteGeneratorAction;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    #[\Override]
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    #[\Override]
    public function menu(): array
    {
        $tables = (new GetTableNameAndCommentAction())->handle();
        return [
            Menu::make(__('general.contacts'))
                ->icon('bs.book')
                ->title(__('general.contacts'))
                ->route('contacts.index'),

            Menu::make(__('general.dictionaries'))
                ->slug('sub-menu')
                ->icon('bs.table')
                ->list(
                    RouteGeneratorAction::handle()
                        ->map(function ($item) use ($tables) {
                            $title = $tables[$item['tableName']]['title'] ?? $item['tableName'];
                            return Menu::make($title)
                                ->icon('bs.app')
                                ->route("platform.dictionaries.{$item['routeName']}.index");
                        })
                        ->toArray(),
                ),
            Menu::make(__('general.main'))
                ->icon('bs.book')
                ->title(__('general.navigation'))
                ->route(config('platform.index')),

            Menu::make(__('general.pages'))
                ->icon('bs.book')
                ->title(__('general.pages'))
                ->route('platform.pages'),

            Menu::make(__('general.table.sync_history'))
                ->icon('bs.ubuntu')
                ->route('platform.sync-history.list'),

            Menu::make(__('general.menus'))
                ->icon('bs.menu-down')
                ->title(__('general.menus'))
                ->route('platform.menus.list'),


            Menu::make()
                ->icon('bs.ubuntu')
                ->route('platform.news.list'),

            Menu::make(__('general.table.block_news'))
                ->icon('bs.newspaper')
                ->list([
                    Menu::make(__('general.news_categories'))
                        ->icon('bs.card-heading')
                        ->route('platform.news.categories.list'),
                    Menu::make(__('general.news'))
                        ->icon('bs.newspaper')
                        ->route('platform.news.list'),
                ]),

            Menu::make(__('general.block_article'))
                ->icon('bs.newspaper')
                ->list([
                    Menu::make(__('general.categories'))
                        ->icon('bs.card-heading')
                        ->route('platform.articles.categories.list'),
                    Menu::make(__('general.article'))
                        ->icon('bs.newspaper')
                        ->route('platform.articles.list'),
                ]),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access Controls')),

            Menu::make(__('Roles'))
                ->icon('bs.shield')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->divider(),

            Menu::make(__('Logs'))
                ->icon('bs.file-medical')
                ->href('/log-viewer'),

            Menu::make(__('Telescope'))
                ->icon('bs.virus')
                ->href('/telescope')

        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    #[\Override]
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
