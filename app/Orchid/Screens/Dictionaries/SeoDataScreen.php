<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\SeoData;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class SeoDataScreen extends Screen
{
    private static string $tableName;

    public function __construct(public SeoData $model)
    {
        self::$tableName = $model->getTable();
    }

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            self::$tableName => $this->model::query()
                ->filters()
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        $action = new GetTableCommentAction();

        return $action($this->model);
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    #[\Override]
    public function commandBar(): iterable
    {
        return [
            //
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     * @throws \ReflectionException
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('url', __('general.table.url')),
                BaseTD::make('h1', __('general.table.h1')),
                BaseTD::make('title', __('general.table.title')),
                BaseTD::make('description', __('general.table.description')),
                BaseTD::make('keywords', __('general.table.keywords')),
                BaseTD::make('breadcrumbs', __('general.table.breadcrumbs')),
                BaseTD::make('text_top', __('general.table.text_top')),
                BaseTD::make('text_bottom', __('general.table.text_bottom')),
            ]),
        ];
    }
}
