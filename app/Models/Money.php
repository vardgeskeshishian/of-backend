<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class Money
 *
 * @package App\Models
 *
 * @property int $id
 * @property float $value
 * @property int $currency_type_id
 * @property-read User|null $currencyType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Money newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Money newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Money query()
 * @method static Builder|Money filters()
 *
 */
class Money extends Model
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
        'value',
        'currency_type_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'value' => 'decimal:2',
        'currency_type_id' => 'integer',
    ];

    protected array $allowedFilters = [
        'value' => Like::class,
    ];

    public function currencyType(): BelongsTo
    {
        return $this->belongsTo(CurrencyType::class, 'currency_type_id');
    }
}
