<?php

namespace App\Models;

use App\Enums\ContactTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

/**
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static Builder|Contact filters()
 */
class Contact extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $fillable = [
        'type',
        'name',
        'phone',
        'email',
        'send_to_whatsapp',
        'send_to_telegram',
        'text',
    ];

    protected $casts = [
        'type' => ContactTypes::class,
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];
}
