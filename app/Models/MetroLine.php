<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class MetroLine
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 *
 * @method static \Illuminate\Database\Eloquent\Builder|MetroLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MetroLine query()
 * @method static Builder|MetroLine filters()
 *
 */
class MetroLine extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     *
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
