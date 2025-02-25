<?php

namespace App\Orchid\Screens\Dictionaries;

use App\Actions\GetTableCommentAction;
use App\Models\CommonBlockImage;
use App\Orchid\BaseTD;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CommonBlockImageScreen extends Screen
{
    private static string $tableName;

    public function __construct(public CommonBlockImage $model)
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
                    'image',
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
                BaseTD::make('common_block_id', __('general.table.common_block'))
                    ->render(fn(CommonBlockImage $model) => e($model->commonBlock?->name)),

                BaseTD::make('image_id', __('general.table.image'))
                    ->render(fn(CommonBlockImage $model) => view('orchid.components.image', [
                        'url' => $model->image?->url,
                    ])),

                BaseTD::make('image_type', __('general.table.image_type')),

                BaseTD::make('sort_order', __('general.table.sort_order')),

            ]),
        ];
    }
}
