<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class Security
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Security newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Security newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Security query()
 * @method static \Illuminate\Database\Eloquent\Builder|Security whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Security whereName($value)
 * @method static Builder|Security filters()
 */
class Security extends Model
{
    use AsSource;
    use Filterable;
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];
}
