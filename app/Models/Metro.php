<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class Metro
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property object $pivot
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Metro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metro query()
 * @method static Builder|Metro filters()
 *
 */
class Metro extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];
}
