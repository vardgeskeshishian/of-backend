<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class MetroMultipleTypes
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultipleTypes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultipleTypes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroMultipleTypes query()
 * @method static Builder|MetroMultipleTypes filters()
 *
 */
class MetroMultipleTypes extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'metro_multiple_types';

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
