<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class CurrencyType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property float $ruble_exchange_rate
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CurrencyType query()
 * @method static Builder|CurrencyType filters()
 *
 */
class CurrencyType extends Model
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
        'code',
        'ruble_exchange_rate',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'ruble_exchange_rate' => 'decimal:5',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];
}
