<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JsonParsingService extends BaseService
{
    /**
     * @throws \Exception
     */
    public function parse($jsonRows): bool
    {
        foreach ($jsonRows as $className => $values) {

            Log::channel('of-json')->debug('row', [
                'className' => $className,
                'values' => $values,
            ]);

            $model = $this->validateAndInitializeClass($className);

            $this->validateColumnCount($model, $values);

            $requestInstance = $this->createRequestInstance($model, $values);

            $validatedData = $this->validateData($requestInstance, $className);

            $this->updateOrCreateModel($model, $validatedData);
        }

        return true;
    }

    /**
     * @throws \Exception
     */
    private function validateColumnCount(Model $model, array $values): void
    {
        $table = $model->getTable();
        $columns = $this->getColumnListing($table);
        $tableColumnCount = count($columns);
        $requestDataCount = count($values);
        if ($tableColumnCount > $requestDataCount) {
            $missingColumns = array_diff_key($columns, $values);
            throw new Exception(sprintf(
                "Table[%s] : Request data count is less than the expected number of columns, expected - %s, passed - %s, differance[ %s ]",
                $table,
                $tableColumnCount,
                $requestDataCount,
                implode(',', $missingColumns),
            ));
        }

        if ($tableColumnCount < $requestDataCount) {
            $missingColumns = array_diff_key($columns, $values);
            throw new Exception(sprintf(
                "Table[%s] : Request data count exceeds the expected number of columns, expected - %s, passed - %s, , differance[ %s ]",
                $table,
                $tableColumnCount,
                $requestDataCount,
                implode(',', $missingColumns),
            ));
        }
    }

    private function getColumnListing(string $table): array
    {
        return Cache::rememberForever("column-listing-for-{$table}", fn() => Schema::getColumnListing($table));
    }

    /**
     * @throws \Exception
     */
    private function validateAndInitializeClass(string $className): Model
    {
        if (!class_exists($className)) {
            throw new Exception("Class $className not found");
        }
        return new $className();
    }

    /**
     * @throws \Exception
     */
    private function createRequestInstance(Model $model, array $values): FormRequest
    {
        $baseName = class_basename($model);
        $requestClass = sprintf('App\\Http\\Requests\\%sRequest', $baseName);

        if (!class_exists($requestClass)) {
            throw new Exception(
                sprintf(
                    'Request class %s not found for %s',
                    $requestClass,
                    $model::class,
                ),
            );
        }

        $requestInstance = new $requestClass();
        $requestInstance->merge($values);

        return $requestInstance;
    }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    private function validateData($requestInstance, string $className): array
    {
        $validator = Validator::make($requestInstance->all(), $requestInstance->rules());

        if ($validator->fails()) {
            throw new Exception(
                sprintf(
                    'Validation failed for %s: %s',
                    $className,
                    implode(', ', $validator->errors()->all()),
                ),
            );
        }

        return $validator->validated();
    }

    /**
     * @throws Exception
     */
    private function updateOrCreateModel(Model $model, array $validatedData): void
    {
        $primaryKeys = $this->getModelPrimaryKeys($model);

        $uniqueKeys = $this->getUniqueKeys($primaryKeys, $validatedData);

        $this->validateUniqueKeys($uniqueKeys, $model);

        $model::query()->updateOrCreate($uniqueKeys, $validatedData);
    }

    /**
     * @throws Exception
     */
    private function validateUniqueKeys(array $keys, $model): void
    {
        if ($keys === []) {
            throw new \Exception(
                sprintf(
                    'Missing %s unique key value for %s',
                    class_basename($model),
                    implode(', ', $keys),
                ),
            );
        }
    }

    private function getModelPrimaryKeys($model): array
    {
        $keys = $model->getKeyName();
        return is_array($keys) ? $keys : [$keys];
    }

    /**
     * @throws \Exception
     */
    private function getUniqueKeys($primaryKeys, &$validatedData): array
    {
        $keys = [];

        foreach ($primaryKeys as $key) {
            if (isset($validatedData[$key])) {
                $keys[$key] = $validatedData[$key];
                unset($validatedData[$key]);
            }
        }

        return $keys;
    }

}
