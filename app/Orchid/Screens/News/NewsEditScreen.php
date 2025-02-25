<?php

namespace App\Orchid\Screens\News;

use App\Http\Requests\News\Store;
use App\Models\News;
use App\Models\NewsBlock;
use App\Models\NewsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;
use Exception;
use OrchidCommunity\TinyMCE\TinyMCE;

class NewsEditScreen extends Screen
{
    public $news;

    public $blocks;

    public const int SORTING_INTERVAL = 10;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(News $news): iterable
    {
        return [
            'news' => $news,
            'blocks' => $news->blocks()->oldest('sorting')->get(),
        ];
    }


    public function isEditAction(): bool
    {
        return !empty($this->news->id);
    }

    /**
     * The name of the screen  in the header.
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
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Editor'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'editor'])
                ->canSee($this->isEditAction()),

            Button::make(__('Image'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'image'])
                ->canSee($this->isEditAction()),

            Button::make(__('Video'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'video'])
                ->canSee($this->isEditAction()),

            Button::make(__('Textarea'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'textarea'])
                ->canSee($this->isEditAction()),

            Button::make(__('general.sources'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'sources'])
                ->canSee($this->isEditAction()),

            Button::make(__('general.quotes'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'quotes'])
                ->canSee($this->isEditAction()),

            Button::make(__('general.info'))
                ->icon('bs.bookmark-plus')
                ->method('addRow', ['block' => 'info'])
                ->canSee($this->isEditAction()),

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
        $layoutItems[] = Layout::rows([
            Relation::make('news.news_category_id')
                ->placeholder(__('general.category'))
                ->title(__('general.category'))
                ->fromModel(NewsCategory::class, 'name'),

            Input::make('news.title')
                ->type('text')
                ->max(255)
                ->title(__('Name'))
                ->placeholder(__('Name')),
        ]);

        foreach ($this->blocks as $block) {
            switch ($block->type) {
                case 'editor':
                    $layoutItems[] = Layout::rows([
                        $this->appendSortingBlock($block),

                        TinyMCE::make("blocks[{$block->id}][content]")
                            ->title(__('Editor Block'))
                            ->value($block->content)
                            ->height(500)
                            ->class('editor-block')
                            ->set('data-editor-id', $block->id),

                        $this->appendActionBlock($block),
                    ]);
                    break;

                case 'image':
                    $layoutItems[] = Layout::rows([
                        $this->appendSortingBlock($block),

                        Upload::make("blocks[{$block->id}][file]")
                            ->title(__('Upload Block'))
                            ->acceptedFiles('.jpg, .jpeg, .png')
                            ->value($block->attachments()->get())
                            ->helper(__('Upload a file for this block')),

                        $this->appendActionBlock($block),
                    ]);
                    break;

                case 'video':
                    $layoutItems[] = Layout::rows([
                        $this->appendSortingBlock($block),

                        Upload::make("blocks[{$block->id}][file]")
                            ->title(__('Upload Block'))
                            ->value($block->attachments()->get())
                            ->acceptedFiles('.mp4, .avi, .mov')
                            ->helper(__('Upload a file for this block')),

                        $this->appendActionBlock($block),
                    ]);
                    break;

                case 'textarea':
                case 'info':
                    $layoutItems[] = Layout::rows([
                        $this->appendSortingBlock($block),

                        TextArea::make("blocks[{$block->id}][content]")
                            ->title(__('Text'))
                            ->value($block->content),

                        $this->appendActionBlock($block),
                    ]);
                    break;
                case 'quotes':
                    $layoutItems[] = Layout::rows([
                        $this->appendSortingBlock($block),

                        Input::make("blocks[{$block->id}][author]")
                            ->title(__('Author'))
                            ->value($block->author),

                        Input::make("blocks[{$block->id}][position]")
                            ->title(__('Position'))
                            ->value($block->position),

                        TextArea::make("blocks[{$block->id}][content]")
                            ->title(__('Text'))
                            ->value($block->content),

                        Upload::make("blocks[{$block->id}][file]")
                            ->title(__('Upload Block'))
                            ->maxFiles(1)
                            ->acceptedFiles('.jpg, .jpeg, .png')
                            ->value($block->attachments()->get())
                            ->helper(__('Upload a file for this block')),

                        $this->appendActionBlock($block),
                    ]);
                    break;
                case 'sources':
                    $layoutItems[] = Layout::rows([

                        $this->appendSortingBlock($block),

                        Matrix::make("blocks[{$block->id}][content]")
                            ->title(__('general.sources'))
                            ->columns([
                                __('general.link') => 'link',
                                __('general.content') => 'content',
                            ])
                            ->value($block->content),

                        $this->appendActionBlock($block),
                    ]);
                    break;
            }
        }

        $layoutItems[] = Layout::view('orchid.fields.tiny');


        return $layoutItems;
    }

    public function addRow(Store $request, News $news): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $news->fill($request->get('news'));

            $news->save();

            $lastBlock = $this->blocks->sortBy('sorting')->last();

            $nextSorting = $lastBlock ? $lastBlock->sorting + self::SORTING_INTERVAL : self::SORTING_INTERVAL;

            $news->blocks()->create([
                'type' => $request->input('block'),
                'sorting' => $nextSorting,
            ]);
            DB::commit();
            return to_route('platform.news.edit', [
                'news' => $news,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('news')->error(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            Toast::error(__('You have some error!'));
            return back();
        }
    }


    private function appendSortingBlock($block): Input
    {
        return Input::make("blocks[{$block->id}][sorting]")
            ->type('number')
            ->title(__('Sorting'))
            ->value($block->sorting);
    }

    private function appendActionBlock($block): Group
    {
        return Group::make([
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Delete Block'))
                ->icon('bs.x-circle')
                ->method('deleteBlock')
                ->parameters(['block_id' => $block->id]),
        ]);
    }


    public function deleteBlock(Request $request): RedirectResponse
    {
        $blockId = $request->input('block_id');

        $block = $this->news->blocks()->find($blockId);
        if ($block) {
            $block->delete();
            Toast::info(__('Block was deleted successfully.'));
        } else {
            Toast::error(__('Block not found.'));
        }

        return back();
    }

    public function save(Store $request, News $news): RedirectResponse
    {
        DB::beginTransaction();
        try {

            $news->fill($request->get('news'));

            $news->save();

            foreach ($request->input('blocks', []) as $blockId => $blockData) {
                /**
                 * @var NewsBlock $block
                 */
                $block = $news->blocks()->find($blockId);
                if ($block) {
                    $block->attachments()->sync(
                        $blockData['file'] ?? [],
                    );

                    $block->update($blockData);
                }
            }
            Toast::info(__('Item was saved'));
            DB::commit();
            return to_route('platform.news.edit', [
                'news' => $news->id,
            ]);
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
