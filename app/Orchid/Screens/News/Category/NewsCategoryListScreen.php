<?php

namespace App\Orchid\Screens\News\Category;

use App\Models\NewsCategory;
use App\Orchid\BaseTD;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class NewsCategoryListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public NewsCategory $model)
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
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.news');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.news');
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
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.news.categories.create')),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    #[\Override]
    public function layout(): iterable
    {
        return [
            Layout::table(self::$tableName, [
                BaseTD::make('id', __('general.table.name'))
                    ->sort(),
                BaseTD::make('name', __('general.table.name'))
                    ->filter(Input::make()),
                BaseTD::make('slug', __('general.table.slug'))
                    ->filter(Input::make()),
                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('120px')
                    ->render(fn(NewsCategory $category) =>
                    Group::make([
                        Link::make()
                            ->route('platform.news.categories.edit', $category->id)
                            ->icon('bs.pencil-square'),
                        Button::make()
                            ->icon('bs.trash3')
                            ->confirm(__('Once the item is deleted, all of its resources and data will be permanently deleted.'))
                            ->method('remove', [
                                'id' => $category->id,
                            ]),
                        ])
                    ),
            ]),
        ];
    }

    public function remove(NewsCategory $category): RedirectResponse
    {
        $category->delete();

        Toast::info(__('Item was removed'));

        return back();
    }
}
