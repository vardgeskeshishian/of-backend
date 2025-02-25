<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class SaleBlockTax

 * @package App\Models
 * @property int $id
 * @property int|null $tax_type_id
 * @property-read TaxType|null $taxType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlockTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlockTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlockTax query()
 */
class SaleBlockTax extends Model
{
    use AsSource;
    use Filterable;
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'tax_type_id',
    ];

    /**
     * Get the tax type associated with the SaleBlockTax.
     */
    public function taxType(): BelongsTo
    {
        return $this->belongsTo(TaxType::class, 'tax_type_id');
    }
}
