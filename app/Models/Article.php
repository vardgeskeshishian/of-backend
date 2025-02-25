<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property string $sources
 * @property int $likes
 * @property int $dislikes
 * @property int $views
 * @property array $hyperlinks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ArticleCategory $category
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Article whereId($value)
 */
class Article extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;
    use HasCreatorAndUpdater;

    protected $fillable = [
        'article_category_id',
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
        return $this->belongsTo(ArticleCategory::class);
    }
}
