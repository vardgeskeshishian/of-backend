<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Orchid\Attachment\Attachable;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class PageBlockable extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;
    use Attachable;

    protected $fillable = [
        'instance_type',
        'instance_id',
        'type',
        'content',
        'sorting',
        'author',
        'position',
    ];

    public function instance(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'instance_type', 'instance_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->attachments->each->delete();
        });

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
