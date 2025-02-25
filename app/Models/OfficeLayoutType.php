<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class OfficeLayoutType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeLayoutType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeLayoutType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeLayoutType query()
 * @method static Builder|OfficeLayoutType filters()
 *
 */
class OfficeLayoutType extends Model
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
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

}
