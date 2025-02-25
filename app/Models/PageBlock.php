<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $page_id
 * @property string $name
 * @property string $slug
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlock updateOrCreate()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlock query()
 * @property-read Collection<int, PageBlockItem> $items
 * @property-read Page $page
 */
class PageBlock extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'page_id',
        'name',
        'slug',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PageBlockItem::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
