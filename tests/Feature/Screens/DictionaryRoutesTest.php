<?php

namespace Screens;

use App\Actions\GetTableCommentAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchid\Support\Facades\Dashboard;
use Orchid\Support\Testing\ScreenTesting;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Tests\TestCase;

class DictionaryRoutesTest extends TestCase
{
    use ScreenTesting;
    use RefreshDatabase;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function test_all_dictionary_routes_have_header_and_text()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'permissions' => [
                ...Dashboard::getAllowAllPermission(),
            ],
        ]);

        $action = new GetTableCommentAction();

        $routes = $this->getAllDictionaryRoutes();

        foreach ($routes as $route) {

            $modelName = $this->getModelName($route['screenName']);
            $model = "App\\Models\\$modelName";

            $screen = $this->screen($route['name'])->actingAs($user);
            $comment = $action(new $model());
            $screen->display()
                ->assertSee($comment);
        }
    }

    protected function getAllDictionaryRoutes(): array
    {
        $routes = [];
        $routeCollection = app('router')->getRoutes();

        foreach ($routeCollection as $route) {
            if (str_contains((string) $route->getName(), 'dictionaries')) {

                $action = $route->getAction();
                $controller = $action['controller'] ?? 'Closure';
                $routes[] = [
                    'name' => $route->getName(),
                    'screenName' => $controller,
                ];
            }
        }
        return $routes;
    }

    public function getModelName($className): string
    {
        $className = class_basename($className);

        if (str_ends_with($className, 'Screen')) {
            return substr($className, 0, -6);
        }

        return $className;
    }
}
