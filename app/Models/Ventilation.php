<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class Ventilation
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Ventilation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventilation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventilation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventilation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventilation whereName($value)
 * @method static Builder|Ventilation filters()
 *
 *
 */
class Ventilation extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

}
