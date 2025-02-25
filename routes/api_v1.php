<?php

use App\Actions\RouteGeneratorAction;
use App\Enums\ApiDictionaryVisibleRoutes;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\BusinessCenterController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\FilterController;
use App\Http\Controllers\API\JsonParsingController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\PageBlockController;
use App\Http\Controllers\API\PageController;
use App\Http\Controllers\API\SelectBoxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::middleware('auth:api')->group(function () {
    Route::post('/parse', JsonParsingController::class);
});

Route::apiResource('contacts', ContactController::class)
    ->only('store');

Route::apiResource('news', NewsController::class)
    ->only(ApiDictionaryVisibleRoutes::values())
    ->scoped([
        'news' => 'slug',
    ]);

Route::apiResource('articles', ArticleController::class)
    ->only(ApiDictionaryVisibleRoutes::values())
    ->scoped([
        'article' => 'slug',
    ]);

Route::apiResource('pages', PageController::class)
    ->only(['show', 'index'])
    ->scoped([
        'page' => 'slug',
    ]);
Route::apiResource('blocks', PageBlockController::class)
    ->only(['show', 'index'])
    ->scoped([
        'block' => 'slug',
    ]);

Route::prefix('business-centers')->group(function () {
    Route::get('search', [BusinessCenterController::class, 'search']);
    Route::get('coordinates', [BusinessCenterController::class, 'coordinates']);
});


Route::get('/select/{table}', [SelectBoxController::class, 'select']);
Route::get('/filters', [FilterController::class, 'filters']);


RouteGeneratorAction::handle()->map(function ($item) {
    $controller = sprintf(
        'App\Http\Controllers\API\Dictionaries\%sController',
        $item['modelName'],
    );
    if (class_exists($controller)) {
        return [
            Route::apiResource("{$item['routeName']}s", $controller)
                ->only(ApiDictionaryVisibleRoutes::values()),
        ];
    }
});
