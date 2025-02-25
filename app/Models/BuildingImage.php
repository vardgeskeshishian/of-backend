<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;
use Thiagoprz\CompositeKey\HasCompositeKey;

/**
 * @property int $building_id
 * @property string $type
 * @property int $sort_order
 * @property int $image_id
 * @property-read Building $building
 * @property-read Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingImage query()
 * @method static Builder|BuildingImage filters()
 *
 */

class BuildingImage extends Model
{
    use HasCompositeKey;
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    protected $table = "building_image";

    protected $primaryKey = ['building_id', 'image_id'];

    public $timestamps = false;

    protected $fillable = [
        'building_id',
        'image_id',
        'type',
        'sort_order',
    ];

    protected array $allowedFilters = [
        'type' => Like::class,
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }

}
