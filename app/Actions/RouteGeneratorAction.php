<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RouteGeneratorAction
{
    public static function handle(): Collection
    {
        return Cache::remember('dictionary-routes', now()->addDay(), function () {
            $requestPath = app_path('Models');
            $files = File::allFiles($requestPath);
            $menus = [];

            foreach ($files as $file) {
                $fileExtension = $file->getExtension();
                $modelName = Str::replace(".$fileExtension", '', $file->getFilename());
                $routeName = Str::kebab($modelName);
                $screenName = "App\\Orchid\\Screens\\Dictionaries\\$modelName" . 'Screen';
                $model = "App\\Models\\{$modelName}";
                /**@var $model Model*/
                $model = new $model();
                $translationKey = Str::of($modelName)->snake();

                if (! class_exists($screenName)) {
                    continue;
                }

                $menus[] = [
                    'screenName' => $screenName,
                    'routeName' => $routeName,
                    'modelName' => $modelName,
                    'translationKey' => $translationKey,
                    'tableName' => $model->getTable(),
                ];
            }

            return collect($menus);
        });
    }
}
