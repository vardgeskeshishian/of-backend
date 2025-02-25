<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property int $page_block_id
 * @property int $attachment_id
 * @property string $name
 * @property string $title
 * @property string $link
 * @property string $type
 * @property string $text
 * @property array $list
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlockItem updateOrCreate()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlockItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlockItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageBlockItem query()
 * @property-read Attachment|null $attachment
 * @property-read PageBlock $block
 */
class PageBlockItem extends Model
{
    use HasFactory;
    use Attachable;
    use AsSource;
    use Filterable;

    public const string MEDIA_FOLDER = 'page_block_item_media';


    protected $fillable = [
        'page_block_id',
        'attachment_id',
        'title',
        'slug',
        'name',
        'link',
        'type',
        'text',
        'list',
    ];

    protected $casts = [
        'list' => 'array',
    ];

    public function block(): BelongsTo
    {
        return $this->belongsTo(PageBlock::class, 'page_block_id');
    }

    public function attachment(): HasOne
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->attachment?->delete();
            $model->attachments->each->delete();
        });
    }
}
