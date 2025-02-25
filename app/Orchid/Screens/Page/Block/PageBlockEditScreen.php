<?php

namespace App\Orchid\Screens\Page\Block;

use App\Http\Requests\Page\Block\Store;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageBlockItem;
use App\Orchid\Layouts\Page\Block\Item\PageBlockItemTableLayout;
use App\Orchid\Layouts\Page\Block\PageBlockEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageBlockEditScreen extends Screen
{
    public $block;
    public $page;
    public $item;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Page $page, PageBlock $block, PageBlockItem $blockItem): iterable
    {
        return [
            'page' => $page,
            'block' => $block,
            'item' => $blockItem,
            'page_block_items' => $block->items()->get(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.edit');
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
        $blocks = [];
        if ($this->block->id) {
            $blocks[] = Layout::rows([
                Link::make(__('Create'))
                    ->route('platform.pages.blocks.items.create', [
                        'page' => $this->page->id,
                        'block' => $this->block->id,
                    ])
                    ->icon('bs.plus'),
            ]);
        }

        if ($this->page->id && $this->block->items()->count()) {
            $blocks[] = PageBlockItemTableLayout::class;
        }

        return [
            Layout::block([
                PageBlockEditLayout::class,
            ])->title('Edit block info'),

            ...$blocks,
        ];
    }

    public function save(Store $request, Page $page, PageBlock $block): RedirectResponse
    {
        try {
            $block->fill($request->validated('block'));
            $block->save();
            Toast::info(__('Success saved'));
            return redirect()->route('platform.pages.edit', $page);
        } catch (\Exception $e) {
            Log::channel('pages')->debug(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            Toast::info(__('Save error!'));
            return back();
        }
    }

    public function remove(Request $request, Page $page, PageBlock $block, PageBlockItem $blockItem): void
    {
        try {
            $blockItem->delete();
            Toast::info(__('Block was removed'));
        } catch (\Exception $e) {
            Log::channel('pages')->debug(__METHOD__, [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            Toast::info(__('Remove error!'));
        }
    }
}
