<?php

declare(strict_types=1);

namespace App\Orchid;

use Illuminate\Support\ServiceProvider;

class MacroProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        BaseTD::macro('bool', function () {
            /**
             * @var BaseTD $this;
             */
            $column = $this->getColumn();

            $this->render(fn($datum) => view('orchid.components.bool', [
                'bool' => $datum->$column,
            ]));

            return $this;
        });
    }
}
