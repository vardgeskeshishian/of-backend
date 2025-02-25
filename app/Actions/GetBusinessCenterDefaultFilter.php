<?php

namespace App\Actions;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class GetBusinessCenterDefaultFilter
{

    const string CACHE_KEY = 'business-center-default-filter';

    public function handle($forget = false): array
    {
        if ($forget) {
            Cache::forget(self::CACHE_KEY);
        }

        return Cache::rememberForever(self::CACHE_KEY, function () {
            return [
                'min_area' => DB::table('common_blocks')->min('min_area'),
                'max_area' => DB::table('common_blocks')->max('max_area'),
                'min_cost' => DB::table('money')->min('value'),
                'max_cost' => DB::table('money')->max('value'),
            ];
        });
    }
}
