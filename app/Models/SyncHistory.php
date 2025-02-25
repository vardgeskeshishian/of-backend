<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use PhpParser\Node\Expr\BinaryOp\Equal;

/**
 * @package App\Models
 *
 * @property int $id
 * @property array $data
 * @property string $status
 * @property string $error_message
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType query()
 * @method static Builder|SyncHistory filters()
 */
class SyncHistory extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;


    protected $casts = [
        'data' => 'json',
        'created_at' => 'datetime:Y-m-d:H:i:s',
        'updated_at' => 'datetime:Y-m-d:H:i:s',
    ];

    protected $fillable = [
        'data',
        'error_message',
        'status',
        'created_at',
        'updated_at',
    ];

    protected array $allowedFilters = [
        'status' => Equal::class,
    ];
}
