<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class RentBlockTax
 *
 * @package App\Models
 *
 * @property int $id
 * @property int|null $tax_type_id
 * @property-read User|null $taxType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlockTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlockTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlockTax query()
 */
class RentBlockTax extends Model
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
        'tax_type_id',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'tax_type_id' => 'integer',
    ];

    public function taxType(): BelongsTo
    {
        return $this->belongsTo(TaxType::class, 'tax_type_id');
    }

}
