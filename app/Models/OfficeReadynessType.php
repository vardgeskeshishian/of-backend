<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class OfficeReadynessType
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OfficeReadynessType query()
 * @method static Builder|OfficeReadynessType filters()
 *
 */
class OfficeReadynessType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps  = false;

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
