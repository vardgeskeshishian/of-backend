<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $sources
 * @property int $likes
 * @property int $dislikes
 * @property int $views
 * @property array $hyperlinks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NewsCategory $category
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @property-read Collection<int, PageBlockable> $blocks
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 */
class News extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;
    use HasCreatorAndUpdater;

    protected $fillable = [
        'news_category_id',
        'creator_id',
        'updater_id',
        'title',
        'slug',
        'content',
        'sources',
        'likes',
        'dislikes',
        'views',
        'hyperlinks',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'sources' => 'array',
        'hyperlinks' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function blocks(): MorphMany
    {
        return $this->morphMany(PageBlockable::class, 'instance')
            ->orderBy('sorting');
    }

    public function cover(): Attachment|null
    {
        $block = $this->blocks()->withWhereHas('attachments', function ($query) {
            $query->where('alt', 'is_main');
        })->first();

        return $block?->attachments?->first();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->blocks()->delete();
        });
    }
}
