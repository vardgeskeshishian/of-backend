<?php

namespace App\Services;

use Illuminate\Http\Request;

class BaseService
{
    public const int PER_PAGE = 20;

    protected function getPerPage(Request $request): int
    {
        return $request->input('per_page', self::PER_PAGE);
    }
}
