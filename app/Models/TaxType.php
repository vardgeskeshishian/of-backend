<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class TaxType
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TaxType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaxType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaxType whereName($value)
 * @method static Builder|TaxType filters()
 *
 */
class TaxType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

}
