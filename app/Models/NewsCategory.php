<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 */
class NewsCategory extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'name',
        'slug',
    ];
}
