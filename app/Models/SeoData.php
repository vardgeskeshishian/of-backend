<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 * Class SeoData
 *
 * @package App\Models
 * @property int $id
 * @property string|null $url
 * @property string|null $h1
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $breadcrumbs
 * @property string|null $text_top
 * @property string|null $text_bottom
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereBreadcrumbs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereH1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereTextBottom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereTextTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeoData whereUrl($value)
 * @method static Builder|SeoData filters()
 *
 */
class SeoData extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'seo_data';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'url',
        'h1',
        'title',
        'description',
        'keywords',
        'breadcrumbs',
        'text_top',
        'text_bottom',
    ];

    protected array $allowedFilters = [
        'title' => Like::class,
    ];

}
