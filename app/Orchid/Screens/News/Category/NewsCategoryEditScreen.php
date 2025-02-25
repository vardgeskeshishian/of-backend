<?php

namespace App\Orchid\Screens\News\Category;

use App\Http\Requests\News\Category\Store;
use App\Models\NewsCategory;
use App\Orchid\Layouts\News\Category\NewsCategoryEditLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class NewsCategoryEditScreen extends Screen
{
    public $category;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(NewsCategory $category): iterable
    {
        return [
            'category' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.news_categories');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.news_categories');
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
            NewsCategoryEditLayout::class,
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(Store $request, NewsCategory $category): RedirectResponse
    {

        $category->fill($request->get('category'));

        $category->save();

        Toast::info(__('Item was saved'));

        return to_route('platform.news.categories.list');
    }
}
