<?php

namespace App\Services;

use App\Enums\SelectBoxTypesEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SelectBoxService extends BaseService
{
    /**
     * @throws \Exception
     */
    public function select(Request $request, $table): \Illuminate\Support\Collection
    {

        if (!SelectBoxTypesEnum::tryFrom($table)) {
            throw new \Exception("Table [$table] is not valid");
        }

        if (!Schema::hasTable($table)) {
            throw new \Exception("Table [$table] does not exist.");
        }

        $query = DB::table($table)->select('id', 'name');

        if ($request->query('q')) {
            $term = $request->query('q');
            $query->where('name', 'like', "%$term%");
        }

        return $query->get();
    }
}
