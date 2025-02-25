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
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AgreementType query()
 * @method static Builder|AgreementType filters()
 */
class PriorityType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];
}
