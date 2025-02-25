<?php

namespace App\Orchid\Screens\Article;

use App\Models\Article;
use App\Orchid\BaseTD;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ArticleListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Article $model)
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
        return __('general.article');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.article');
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
                ->href(route('platform.articles.create')),
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
                BaseTD::make('title', __('general.table.title'))
                    ->filter(Input::make()),
                BaseTD::make('slug', __('general.table.slug'))
                    ->filter(Input::make()),

                BaseTD::make('creator_id', __('general.table.creator'))
                    ->render(fn(Article $model) => e($model->creator?->name)),

                BaseTD::make('updater_id', __('general.table.updater'))
                    ->render(fn(Article $model) => e($model->updater?->name)),

                BaseTD::make('created_at', __('general.table.created_at'))
                    ->usingComponent(DateTimeSplit::class)
                    ->sort(),

                BaseTD::make('updated_at', __('general.table.updated_at'))
                    ->usingComponent(DateTimeSplit::class),

                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('120px')
                    ->render(fn(Article $article) =>
                    Group::make([
                        Link::make()
                            ->route('platform.articles.edit', $article->id)
                            ->icon('bs.pencil-square'),
                        Button::make()
                            ->icon('bs.trash3')
                            ->confirm(__('Once the item is deleted, all of its resources and data will be permanently deleted.'))
                            ->method('remove', [
                                'id' => $article->id,
                            ]),
                        ])
                    ),
            ]),
        ];
    }


    public function remove(Article $article): RedirectResponse
    {
        $article->delete();

        Toast::info(__('Item was removed'));

        return back();
    }
}
