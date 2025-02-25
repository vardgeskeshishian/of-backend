<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class UtilityCostType
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityCostsType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityCostsType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityCostsType query()
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityCostsType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UtilityCostsType whereName($value)
 * @method static Builder|UtilityCostsType filters()
 *
 */
class UtilityCostsType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
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
