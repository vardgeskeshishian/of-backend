<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class SaleContractType
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SaleContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleContractType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleContractType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleContractType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleContractType whereName($value)
 * @method static Builder|SaleContractType filters()
 *
 */
class SaleContractType extends Model
{
    use AsSource;
    use Filterable;
    use HasFactory;

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
