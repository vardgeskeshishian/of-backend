<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\CommonBlockTag;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CommonBlockTagScreen extends Screen
{
    private static string $tableName;

    public function __construct(public CommonBlockTag $model)
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
                ->with([
                    'commonBlock',
                    'tag',
                ])
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
     *
     * @throws \ReflectionException
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('common_block_id', __('general.table.common block'))
                    ->render(fn(CommonBlockTag $model) => e($model->commonBlock?->name)),

                BaseTD::make('tag_id', __('general.table.tag'))
                    ->render(fn(CommonBlockTag $model) => e($model->tag?->name)),

            ]),
        ];
    }
}
