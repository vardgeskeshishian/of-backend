<?php

namespace App\Orchid\Screens;

use App\Models\Contact;
use App\Orchid\BaseTD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ContactScreen extends Screen
{
    private static string $tableName;

    public function __construct(public Contact $model)
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
                ->filters()
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    #[\Override]
    public function name(): ?string
    {
        return __('general.contacts');
    }

    /**
     * Display header description.
     */
    #[\Override]
    public function description(): ?string
    {
        return __('general.contacts_table');
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
            //
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
                BaseTD::make('type', __('general.table.type'))
                    ->filter(Input::make()),
                BaseTD::make('name', __('general.table.name'))
                    ->filter(Input::make()),
                BaseTD::make('phone', __('general.table.phone'))
                    ->filter(Input::make()),
                BaseTD::make('email', __('general.table.email'))
                    ->filter(Input::make()),
            ]),
        ];
    }
}
