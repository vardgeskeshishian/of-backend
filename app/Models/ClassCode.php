<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $name
 * @property int $sort_order
 * @method static \Illuminate\Database\Eloquent\Builder|ClassCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ClassCode query()
 * @method static Builder|ClassCode filters()
 */
class ClassCode extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'sort_order',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

}
