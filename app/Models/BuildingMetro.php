<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $building_id
 * @property int $metro_id
 * @property int $time_foot
 * @property int $time_car
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingMetro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingMetro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingMetro query()
 * @property-read Building|null $building
 * @property-read Metro|null $metro
 */
class BuildingMetro extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'building_metro';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'building_id',
        'metro_id',
        'time_foot',
        'time_car',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function metro(): BelongsTo
    {
        return $this->belongsTo(Metro::class, 'metro_id');
    }
}
