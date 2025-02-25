<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Tests\TestCase;

class RequestFormsTest extends TestCase
{
    public function testRequestClassesHaveValidModels()
    {
        $requestClasses = $this->getAllRequestClasses();
        $exceptionList = ['BaseFormRequest'];

        foreach ($requestClasses as $requestClass) {
            if ($this->shouldSkipClass($requestClass, $exceptionList)) {
                continue;
            }

            $model = $this->getModelFromRequest($requestClass);

            if (class_exists($model)) {
                $this->assertTrue(true);
            } else {
                $this->fail("No model found for request class '{$requestClass}'.");
            }
        }
    }

    protected function getAllRequestClasses(): array
    {
        $requestPath = app_path('Http/Requests');
        $files = File::allFiles($requestPath);
        $requestClasses = [];

        foreach ($files as $file) {
            $path = $file->getRealPath();
            $namespace = $this->getNamespace($path);
            $requestClasses = array_merge($requestClasses, $this->getClassNamesFromNamespace($namespace, $file));
        }

        return $requestClasses;
    }

    protected function shouldSkipClass($requestClass, $exceptionList): bool
    {
        if (!is_subclass_of($requestClass, \Illuminate\Foundation\Http\FormRequest::class)) {
            return true;
        }

        $requestInstance = new $requestClass();
        $requestClassName = $requestInstance::class;
        return in_array(class_basename($requestClassName), $exceptionList);
    }

    protected function getModelFromRequest($requestClass): string
    {
        $modelClass = str_replace('Request', '', class_basename($requestClass));
        return trim('App\\Models\\' . $modelClass);
    }

    protected function getNamespace($path): string
    {
        $fileName = pathinfo((string) $path, PATHINFO_FILENAME);
        $namespace = 'App\\Http\\Requests';

        if (str_contains($fileName, 'Request')) {
            return $namespace;
        }

        return '';
    }

    protected function getClassNamesFromNamespace($namespace, $file): array
    {
        $className = Str::replace('.php', '', $file->getFilename());
        return [$namespace . '\\' . $className];
    }
}
