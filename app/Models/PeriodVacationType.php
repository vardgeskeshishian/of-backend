<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 *
 * @package App\Models
 * @property int $id
 * @property int $count
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType query()
 * @method static Builder|AgreementType filters()
 */
class PeriodVacationType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'count',
        'value',
    ];

    protected array $allowedFilters = [
        'value' => Like::class,
    ];
}
