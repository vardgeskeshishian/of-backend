<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 * Class MetroMultiple
 *
 * @package App\Models
 *
 * @property int $metro_multiple_types_id
 * @property int $metro_id
 * @property-read MetroMultipleTypes|null $metroMultipleType
 * @property-read Metro|null $metro
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultiple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultiple newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultiple query()
 */
class MetroMultiple extends Model
{
    use HasCompositeKey;
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    protected $primaryKey = ['metro_multiple_types_id', 'metro_id'];

    /**
     * @var array
     */
    protected $fillable = [
        'metro_multiple_types_id',
        'metro_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metro_multiple_types_id' => 'integer',
        'metro_id' => 'integer',
    ];

    public function metro(): BelongsTo
    {
        return $this->belongsTo(Metro::class, 'metro_id');
    }

    public function metroMultipleType(): BelongsTo
    {
        return $this->belongsTo(MetroMultipleType::class, 'metro_multiple_types_id');
    }

}
