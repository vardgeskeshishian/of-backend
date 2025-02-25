<?php

namespace App\Orchid\Screens\Article;

use App\Http\Requests\Article\Store;
use App\Models\Article;
use App\Orchid\Layouts\Article\ArticleEditLayout;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ArticleEditScreen extends Screen
{
    public $article;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Article $article): iterable
    {
        return [
            'article' => $article,
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
            ArticleEditLayout::class,
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(Store $request, Article $article): RedirectResponse
    {
        $article->fill($request->get('article'));

        $article->save();

        $article->attachments()->syncWithoutDetaching(
            $request->input('article.attachments', []),
        );

        Toast::info(__('Item was saved'));

        return to_route('platform.articles.list');
    }
}
