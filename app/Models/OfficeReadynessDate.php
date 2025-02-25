<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class OfficeReadynessDate
 *
 * @package App\Models
 *
 * @property int $id
 * @property int|null $common_block_id
 * @property Carbon $date
 * @property-read User|null $commonBlock
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessDate query()
 */
class OfficeReadynessDate extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;
    /**
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'date',
    ];

    /**
     *
     * @var array
     */
    protected $casts = [
        'common_block_id' => 'integer',
        'date' => 'date',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

}
