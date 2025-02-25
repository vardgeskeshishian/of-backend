<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class Coworking
 *
 * @package App\Models
 *
 * @property int $id
 * @property int|null $rent_block_id
 * @property int|null $coworking_operator_type_id
 * @property int $working_place_count
 * @property int $free_place_count
 *
 * @property-read \App\Models\RentBlock|null $rentBlock
 * @property-read \App\Models\CoworkingOperatorType|null $coworkingOperatorType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Coworking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coworking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coworking query()
 */
class Coworking extends Model
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
        'rent_block_id',
        'coworking_operator_type_id',
        'working_place_count',
        'free_place_count',
    ];

    public function rentBlock(): BelongsTo
    {
        return $this->belongsTo(RentBlock::class, 'rent_block_id');
    }

    public function coworkingOperatorType(): BelongsTo
    {
        return $this->belongsTo(CoworkingOperatorType::class, 'coworking_operator_type_id');
    }
}
