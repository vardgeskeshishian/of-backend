<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 *
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @method static Builder|Assignment newModelQuery()
 * @method static Builder|Assignment newQuery()
 * @method static Builder|Assignment query()
 * @method static Builder|Assignment filters()
 */
class Assignment extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

}
