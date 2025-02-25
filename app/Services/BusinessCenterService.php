<?php

namespace App\Services;

use App\Models\Building;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BusinessCenterService extends BaseService
{
    /**
     * @throws \Exception
     */
    public function search(Request $request): LengthAwarePaginator
    {
        $query = $this->getQuery($request);

        return $query->paginate(
            perPage: $this->getPerPage($request),
        );
    }

    /**
     * @throws \Exception
     */
    public function coordinates(Request $request): Collection
    {
        $query = $this->getQuery($request);

        return $query->pluck('coordinates', 'id');
    }
    /**
     * @throws \Exception
     */
    public function getQuery(Request $request): Builder
    {
        $filterType = $request->input('filter_type', 'rent');
        $minCost = $request->input('min_cost');
        $maxCost = $request->input('max_cost');
        $minArea = $request->input('min_area');
        $maxArea = $request->input('max_area');
        $hasParking = $request->boolean('has_parking');
        $isFurnished = $request->boolean('is_furnished');
        $blockTypes = $request->input('block_types', []);
        $timeFoot = $request->input('time_foot', []);
        $search = $request->input('search');
        $classCodes = $request->input('class_codes', []);
        $assignment = $request->input('assignment');
        $districtTypes = $request->input('district_types', []);
        $officeReadynessTypes = $request->input('office_readyness_types', []);
        $officeLayoutTypes = $request->input('office_layout_types', []);
        $taxesDepartmentNumber = $request->input('taxes_department_number');
        return Building::query()
            ->when($taxesDepartmentNumber, function ($query, $term) {
                $query->where('taxes_department_number', trim($term));
            })
            ->when($search, function ($query, $searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('address', 'like', "%{$searchTerm}%");
                });
            })
            ->when(count($classCodes), function ($query) use ($classCodes) {
                $query->whereHas('classCode', function ($query) use ($classCodes) {
                    $query->whereIn('name', $classCodes);
                });
            })
            ->when($assignment, function ($query) use ($assignment) {
                $query->whereHas('assignment', function ($query) use ($assignment) {
                    $query->where('name', $assignment);
                });
            })
            ->when(count($districtTypes), function ($query) use ($districtTypes) {
                $query->whereHas('districtType', function ($query) use ($districtTypes) {
                    $query->whereIn('name', $districtTypes);
                });
            })
            ->when(count($timeFoot), function ($query) use ($timeFoot) {
                $query->whereHas('metros', function ($query) use ($timeFoot) {
                    $query->whereIn('building_metro.time_foot', $timeFoot);
                });
            })
            ->with('images')
            ->withWhereHas('commonBlocks', function ($query) use (
                $minCost,
                $maxCost,
                $minArea,
                $maxArea,
                $filterType,
                $hasParking,
                $isFurnished,
                $blockTypes,
                $officeReadynessTypes,
                $officeLayoutTypes,
            ) {
                $query->when($minArea, function ($query, $term) {
                    $query->where('useful_area', '>=', $term);
                })
                ->when($maxArea, function ($query, $term) {
                    $query->where('useful_area', '<=', $term);
                })
                ->when($hasParking, function ($query) {
                    $query->where('max_parking_size', '>', 0);
                })
                ->when($isFurnished, function ($query, $term) {
                    $query->where('is_furnished', '=', $term);
                })
                ->withWhereHas('blockType', function ($query) use ($blockTypes) {
                    $query->when($blockTypes, function ($query) use ($blockTypes) {
                        $query->whereIn('name', $blockTypes);
                    });
                })
                ->withWhereHas('officeReadynessType', function ($query) use ($officeReadynessTypes) {
                    $query->when($officeReadynessTypes, function ($query) use ($officeReadynessTypes) {
                        $query->whereIn('name', $officeReadynessTypes);
                    });
                })
                ->withWhereHas('officeLayoutType', function ($query) use ($officeLayoutTypes) {
                    $query->when($officeLayoutTypes, function ($query) use ($officeLayoutTypes) {
                        $query->whereIn('name', $officeLayoutTypes);
                    });
                })
                ->when($filterType === 'rent', function ($query) use ($minCost, $maxCost) {
                    $query->withWhereHas('rentBlocks', function ($query) use ($minCost, $maxCost) {
                        $query->withWhereHas('priceMeterYear', function ($query) use ($minCost, $maxCost) {
                            $query->when($minCost, function ($query, $term) {
                                $query->where('value', '>=', $term);
                            });
                            $query->when($maxCost, function ($query, $term) {
                                $query->where('value', '<=', $term);
                            });
                        });
                    });
                })
                ->when($filterType === 'sale', function ($query) use ($minCost, $maxCost) {
                    $query->withWhereHas('saleBlocks', function ($query) use ($minCost, $maxCost) {
                        $query->withWhereHas('pricePerMeter', function ($query) use ($minCost, $maxCost) {
                            $query->whereBetween('value', [$minCost, $maxCost]);
                        });
                    });
                });
            });
    }
}
