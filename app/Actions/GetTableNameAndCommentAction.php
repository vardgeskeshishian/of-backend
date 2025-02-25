<?php

namespace App\Actions;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GetTableNameAndCommentAction
{
    public function handle()
    {
        return Cache::rememberForever('table-names-and-comments', function (): array {
            $tables = DB::select(
                "
                SELECT
                    table_name as table_name,
                    table_comment as comment
                FROM information_schema.tables
                WHERE table_comment <> ?
                AND table_schema = ?
                ",
                ['', DB::connection()->getDatabaseName()],
            );

            return collect($tables)
                ->mapWithKeys(fn($item) => [
                    $item->table_name => [
                        'comment' => $item->comment,
                        'title' => $this->transformForTitle($item->comment),
                    ],
                ])
                ->toArray();
        });
    }

    private function transformForTitle(string $comment): string
    {
        return Str::length($comment) > 20
            ? Str::limit($comment, 20, ' ...')
            : Str::remove('.', $comment);
    }

}
