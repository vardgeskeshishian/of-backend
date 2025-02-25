<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Page updateOrCreate()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @property-read Collection<int, PageBlock> $blocks
 * @property-read Collection<int, Menu> $menus
 */

class Page extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the comments for the blog post.
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class);
    }
}
