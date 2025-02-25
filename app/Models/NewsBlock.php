<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $news_id
 * @property string $type
 * @property integer $sorting
 * @property string $content
 * @property-read Collection<int, Attachment> $attachments
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 */
class NewsBlock extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;

    protected $fillable = [
        'news_id',
        'type',
        'content',
        'sorting',
    ];

    protected $casts = [
        'sorting' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (is_array($model->content)) {
                $model->content = json_encode($model->content);
            } elseif (is_string($model->content)) {
                $model->content = (string) $model->content;
            }
        });
    }

    public function getContentAttribute($value): array|string|null
    {
        if (is_string($value)) {
            $decodedValue = json_decode($value, true);

            return is_array($decodedValue) ? $decodedValue : $value;
        }

        return $value;
    }
}
