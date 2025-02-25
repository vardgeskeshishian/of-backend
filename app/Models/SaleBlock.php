<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class SaleBlock
 *
 * @package App\Models
 * @property int $id
 * @property int|null $common_block_id
 * @property int|null $sale_block_tax_id
 * @property int|null $price_per_meter_id
 * @property int $is_juridical_saller
 * @property int $sale_contract_type_id
 *
 * @property-read CommonBlock|null $commonBlock
 * @property-read Money|null $pricePerMeter
 * @property-read SaleBlockTax|null $saleBlockTax
 * @property-read SaleContractType $saleContractType
 * @property-read TargetSalesType|null $targetSalesType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock whereCommonBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock whereIsJuridicalSaller($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock wherePricePerMeterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock whereSaleBlockTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SaleBlock whereSaleContractTypeId($value)
 */
class SaleBlock extends Model
{
    use HasFactory;
    use HasCreatorAndUpdater;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'sale_block_tax_id',
        'price_per_meter_id',
        'is_juridical_saller',
        'sale_contract_type_id',
        'target_sales_type_id',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function pricePerMeter(): BelongsTo
    {
        return $this->belongsTo(Money::class, 'price_per_meter_id');
    }

    public function saleBlockTax(): BelongsTo
    {
        return $this->belongsTo(SaleBlockTax::class, 'sale_block_tax_id');
    }

    /**
     * Get the sale contract type associated with the SaleBlock.
     */
    public function saleContractType(): BelongsTo
    {
        return $this->belongsTo(SaleContractType::class, 'sale_contract_type_id');
    }

    public function targetSalesType(): BelongsTo
    {
        return $this->belongsTo(TargetSalesType::class, 'target_sales_type_id');
    }

}
