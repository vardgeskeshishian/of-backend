<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Orchid\BaseTD;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class NewsListScreen extends Screen
{
    private static string $tableName;

    public function __construct(public News $model)
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
                ->href(route('platform.news.create')),
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
                    ->render(fn(News $model) => e($model->creator?->name)),

                BaseTD::make('updater_id', __('general.table.updater'))
                    ->render(fn(News $model) => e($model->updater?->name)),

                BaseTD::make('created_at', __('general.table.created_at'))
                    ->usingComponent(DateTimeSplit::class)
                    ->sort(),

                BaseTD::make('updated_at', __('general.table.updated_at'))
                    ->usingComponent(DateTimeSplit::class),

                BaseTD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('160px')
                    ->render(
                        fn(News $news) =>
                            Group::make([
                                Link::make()
                                    ->route('platform.news.edit', $news->id)
                                    ->icon('bs.pencil-square'),
                                Button::make()
                                    ->icon('bs.trash3')
                                    ->confirm(__('Once the item is deleted, all of its resources and data will be permanently deleted.'))
                                    ->method('remove', [
                                        'news' => $news->id,
                                    ]),
                                Button::make()
                                    ->icon('bs.copy')
                                    ->method('replicate', [
                                        'news' => $news->id,
                                    ]),
                            ])->alignCenter(),
                    ),
            ]),
        ];
    }


    public function remove(News $news): RedirectResponse
    {
        $news->delete();

        Toast::info(__('Item was removed'));

        return back();
    }

    public function replicate(News $news): RedirectResponse
    {
        try {
            $newNews = $news->replicate();

            $newTitle = $news->title . '/ COPY # ' . Str::random(4);
            $newSlug = Str::slug($newTitle);

            $newNews->title = $newTitle;
            $newNews->slug = $newSlug;

            $newNews->created_at = now();
            $newNews->updated_at = now();

            $newNews->save();

            foreach ($news->blocks as $block) {
                $newBlock = $block->replicate();
                $newBlock->instance_type = $newNews->getMorphClass();
                $newBlock->instance_id = $newNews->id;
                $newBlock->save();
            }

            Toast::info(__('Item was successfully replicated.'));
            DB::commit();
            return back();
        } catch (Exception $e) {
            DB::rollBack();
            Toast::error(__('Saving error!'));
            Log::channel('news')->error(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back();
        }
    }
}
