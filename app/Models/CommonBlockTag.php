<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class CommonBlockTag
 *
 * @package App\Models
 *
 * @property int $id
 * @property int $common_block_id
 * @property int $tag_id
 *
 * @property-read CommonBlock $commonBlock
 * @property-read Tag $tag
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlockTag query()
 */
class CommonBlockTag extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'common_block_tag';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'tag_id',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
