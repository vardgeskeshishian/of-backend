<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

class GetTableCommentAction
{
    public function __invoke($model): string|null
    {
        $tableName = $model->getTable();

        $comment = DB::selectOne("
            SELECT table_comment as comment
            FROM information_schema.tables
            WHERE table_schema = ?
            AND table_name = ?
        ", [env('DB_DATABASE'), $tableName]);

        return $comment ? $comment->comment : null;
    }

}
