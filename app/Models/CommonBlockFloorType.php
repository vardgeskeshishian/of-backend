<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 * Class CommonBlockFloorType
 *
 * @package App\Models
 *
 * @property int $common_block_id
 * @property int $floor_type_id
 *
 * @property-read \App\Models\CommonBlock $commonBlock
 * @property-read \App\Models\FloorType $floorType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockFloorType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockFloorType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockFloorType query()
 */
class CommonBlockFloorType extends Model
{
    use HasCompositeKey;
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'common_block_floor_type';

    public $timestamps = false;

    /**
     *
     * @var array
     */
    protected $primaryKey = ['common_block_id', 'floor_type_id'];

    /**
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'common_block_id',
        'floor_type_id',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function floorType(): BelongsTo
    {
        return $this->belongsTo(FloorType::class, 'floor_type_id');
    }
}
