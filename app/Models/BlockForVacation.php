<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * App\Models\BlockForVacation
 *
 * @property int $id
 * @property int $common_block_id
 * @property Carbon|null $date
 * @property int|null $period_vacation_type_id
 *
 * @property-read CommonBlock $commonBlock
 * @property-read PeriodVacationType|null $periodVacationType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation whereCommonBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockForVacation wherePeriodVacationTypeId($value)
 * @method static Builder|Assignment filters()
 */
class BlockForVacation extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'date',
        'period_vacation_type_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'common_block_id' => 'integer',
        'period_vacation_type_id' => 'integer',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function periodVacationType(): BelongsTo
    {
        return $this->belongsTo(PeriodVacationType::class, 'period_vacation_type_id');
    }
}
