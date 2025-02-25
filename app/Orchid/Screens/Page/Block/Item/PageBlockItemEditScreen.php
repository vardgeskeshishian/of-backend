<?php

namespace App\Orchid\Screens\Page\Block\Item;

use App\Http\Requests\Page\Block\Item\Store;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageBlockItem;
use App\Orchid\Listeners\Page\Block\Item\PageBlockItemFormListener;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageBlockItemEditScreen extends Screen
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
            'item' => $blockItem->load('attachments'),
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
        return [
            PageBlockItemFormListener::class,
        ];
    }

    public function save(Store $request, Page $page, PageBlock $block, PageBlockItem $blockItem): RedirectResponse
    {
        $validatedItem = $request->validated('item');

        $blockItem->fill([
            'page_block_id' => $block->id,
            'name' => $validatedItem['name'],
            'title' => $validatedItem['title'] ?? null,
            'slug' => $validatedItem['slug'] ?? null,
            'type' => $validatedItem['type'] ?? null,
            'link' => $validatedItem['link'] ?? null,
            'text' => $validatedItem['text'] ?? null,
            'list' => $validatedItem['list'] ?? null,
            'attachment_id' => !empty($validatedItem['attachment_id'])
                 ? array_shift($validatedItem['attachment_id'])
                 : null,
        ]);

        $blockItem->save();

        $blockItem->attachments()->sync(
            $request->input('item.attachments', []),
        );

        Toast::info(__('Success saved'));
        return redirect()->route('platform.pages.blocks.edit', ['page' => $page, 'block' => $block]);
    }
}
