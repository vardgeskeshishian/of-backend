<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $menu_item_category_id
 * @property string $name
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\MenuItemCategory|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuItem whereId($value)
 */
class MenuItem extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;

    protected $fillable = [
        'menu_item_category_id',
        'name',
        'value',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuItemCategory::class, 'menu_item_category_id');
    }
}
