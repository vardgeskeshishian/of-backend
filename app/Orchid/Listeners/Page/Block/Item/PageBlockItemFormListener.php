<?php

namespace App\Orchid\Listeners\Page\Block\Item;

use App\Models\PageBlockItem;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Listener;
use Orchid\Screen\Repository;
use Orchid\Support\Facades\Layout;
use OrchidCommunity\TinyMCE\TinyMCE;

class PageBlockItemFormListener extends Listener
{
    protected $targets = [
        'item.type',
    ];

    public const string DEFAULT_TYPE = 'social';

    public string $type;

    public string $availableExtensions = '';

    private function layoutInit(): void
    {
        if ($this->query->get('item')) {
            $this->type = $this->query->get('item.type') ?? self::DEFAULT_TYPE;
        }
        $this->refreshExtension();
    }

    private function refreshExtension(): void
    {
        $this->availableExtensions = match ($this->type) {
            'image', 'logo', 'social', 'info' => '.jpg, .png',
            'video' => '.mp4',
            default => '',
        };
    }

    /**
     * @return iterable
     */
    protected function layouts(): iterable
    {

        $this->layoutInit();

        return [
            Layout::rows([
                Select::make('item.type')
                    ->options([
                        'social' => 'Social',
                        'list' => 'List',
                        'logo' => 'Logo',
                        'info' => 'Info',
                        'video' => 'Video',
                        'image' => 'Image',
                        'editor' => 'Editor',
                        'card' => 'Card',
                        'gallery' => 'Gallery',
                    ])
                    ->value($this->type)
                    ->empty()
                    ->title(__('Type')),

                Input::make('item.page_block_id')
                    ->hidden(),

                Input::make('item.name')
                    ->type('text')
                    ->max(255)
                    ->title(__('System') . ' ' . __('Name'))
                    ->placeholder(__('Admin') . ' ' . __('Name')),

                Input::make('item.title')
                    ->max(255)
                    ->title(__('Title'))
                    ->placeholder(__('Title'))
                    ->canSee(in_array($this->type, ['card', 'info'])),

                Input::make('item.link')
                    ->type('text')
                    ->title(__('Link'))
                    ->placeholder(__('Link'))
                    ->canSee(in_array($this->type, ['social', 'logo', 'card'])),

                TextArea::make('item.text')
                    ->title(__('Text'))
                    ->placeholder(__('Text'))
                    ->canSee(!in_array($this->type, ['editor', 'card'])),

                Matrix::make('item.list')
                    ->columns([
                        'Value' => 'value',
                        'Additional' => 'additional',
                        'Mark' => 'mark',
                    ])
                    ->canSee(in_array($this->type, ['list', 'card'])),

                TinyMCE::make("item.text")
                    ->title(__('Editor Block'))
                    ->height(500)
                    ->canSee(in_array($this->type, ['editor', 'card'])),

                Upload::make('item.attachments')
                    ->title('Gallery')
                    ->storage(PageBlockItem::MEDIA_FOLDER)
                    ->canSee(in_array($this->type, ['gallery'])),

                Upload::make('item.attachment_id')
                    ->required()
                    ->maxFiles(1)
                    ->multiple(false)
                    ->acceptedFiles($this->availableExtensions)
                    ->storage(PageBlockItem::MEDIA_FOLDER)
                    ->title('Logo')
                    ->canSee(in_array($this->type, ['logo', 'social', 'image', 'video', 'card', 'info'])),
            ]),

            Layout::view('orchid.fields.tiny'),
        ];
    }

    /**
     * @param Repository $repository
     * @param Request $request
     * @return Repository
     */
    public function handle(Repository $repository, Request $request): Repository
    {
        $this->type = $request->input('item.type', self::DEFAULT_TYPE);
        $this->refreshExtension();
        return $repository
            ->set('item.name', $request->input('item.name'))
            ->set('item.type', $request->input('item.type'))
            ->set('item.link', $request->input('item.link'))
            ->set('item.text', $request->input('item.text'))
            ->set('item.list', $request->input('item.list'))
            ->set('item.attachment_id', $request->input('item.attachment_id'));
    }
}
