<?php

namespace App\Services;

use App\Actions\GetBusinessCenterDefaultFilter;
use App\Enums\SelectBoxTypesEnum;
use Illuminate\Http\Request;

class FilterService extends BaseService
{
    public function __construct(public SelectBoxService $service) {}

    /**
     * @throws \Exception
     */
    public function getFilters(Request $request): array
    {
        $filters = [];

        foreach (SelectBoxTypesEnum::values() as $key) {
            $filters[$key] = $this->service->select($request, $key);
        }

        return [
            ...(new GetBusinessCenterDefaultFilter())->handle(),
            ...$filters,
        ];
    }

}
