<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class CommonBlockImage
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $common_block_id
 * @property int $image_id
 * @property string|null $image_type
 * @property int $sort_order
 *
 * @property-read CommonBlock $commonBlock
 * @property-read Image $image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockImage query()
 */
class CommonBlockImage extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'image_id',
        'image_type',
        'sort_order',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'image_id');
    }
}
