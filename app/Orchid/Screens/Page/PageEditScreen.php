<?php

namespace App\Orchid\Screens\Page;

use App\Http\Requests\Page\Store;
use App\Models\Page;
use App\Models\PageBlock;
use App\Orchid\Layouts\Page\Block\PageBlockTableLayout;
use App\Orchid\Listeners\Page\PageInfoListener;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PageEditScreen extends Screen
{
    public $page;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Page $page): iterable
    {
        return [
            'page' => $page,
            'page_blocks' => $page->blocks,
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
        if ($this->page->id) {
            $blocks[] = Layout::rows([
                Link::make(__('Create'))
                    ->route('platform.pages.blocks.create', ['page' => $this->page->id])
                    ->icon('bs.plus'),
            ]);
        }
        if ($this->page->id && $this->page->blocks()->count()) {
            $blocks[] = PageBlockTableLayout::class;
        }
        return [
            Layout::block([
                PageInfoListener::class,
            ])->title('Info'),

            ...$blocks,
        ];
    }

    public function save(Store $request, Page $page): RedirectResponse
    {
        $page->fill($request->validated('page'));
        $page->save();
        Toast::info(__('Success saved'));
        return redirect()->route('platform.pages');
    }


    public function remove(Request $request): void
    {
        PageBlock::findOrFail($request->get('id'))->delete();

        Toast::info(__('Page was removed'));
    }
}
