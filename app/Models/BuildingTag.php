<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $building_id
 * @property int $tag_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingTag query()
 * @property-read Building|null $building
 * @property-read Tag|null $tag
 */
class BuildingTag extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'building_tag';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'building_id',
        'tag_id',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
