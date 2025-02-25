<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class MetroMetroLine
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $metro_id
 * @property int $metro_line_id
 *
 * @property-read MetroLine|null $metroLine
 * @property-read Metro|null $metro
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMetroLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMetroLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMetroLine query()
 */
class MetroMetroLine extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'metro_metro_line';

    public $incrementing = false;

    public $timestamps = false;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'metro_id',
        'metro_line_id',
    ];

    /**
     *
     * @var array
     */
    protected $casts = [
        'metro_id' => 'integer',
        'metro_line_id' => 'integer',
    ];

    public function metro(): BelongsTo
    {
        return $this->belongsTo(Metro::class, 'metro_id');
    }

    public function metroLine(): BelongsTo
    {
        return $this->belongsTo(MetroLine::class, 'metro_line_id');
    }
}
