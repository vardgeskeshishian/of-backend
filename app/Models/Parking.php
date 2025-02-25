<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Parking
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $building_id
 * @property int|null $currency_id
 * @property int|null $type_id
 * @property int $count
 * @property float $price
 * @property bool $nds
 *
 * @property-read Building $building
 * @property-read ParkingType|null $parkingType
 * @property-read CurrencyType|null $currencyType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Parking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parking query()
 * @method static Builder|Parking filters()
 *
 */
class Parking extends Model
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
        'building_id',
        'currency_id',
        'type_id',
        'count',
        'price',
        'nds',
    ];

    /**
     *
     * @var array
     */
    protected $casts = [
        'building_id' => 'integer',
        'currency_id' => 'integer',
        'type_id' => 'integer',
        'count' => 'integer',
        'price' => 'float',
        'nds' => 'boolean',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function parkingType(): BelongsTo
    {
        return $this->belongsTo(ParkingType::class, 'type_id');
    }

    public function currencyType(): BelongsTo
    {
        return $this->belongsTo(CurrencyType::class, 'currency_id');
    }
}
