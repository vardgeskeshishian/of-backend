<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class RentBlock
 *
 * @package App\Models
 * @property int $id
 * @property int $common_block_id
 * @property bool $is_coworking
 * @property int|null $price_meter_year_id
 * @property int|null $operational_cost_id
 * @property int $rent_block_tax_id
 * @property int|null $rent_contract_type_id
 * @property int $utility_costs_type_id
 * @property int $contract_term_type_id
 * @property int|null $deposit
 *
 * @property-read CommonBlock $commonBlock
 * @property-read Money $priceMeterYear
 * @property-read Money $operationalCost
 * @property-read RentBlockTax $rentBlockTax
 * @property-read RentContractType $rentContractType
 * @property-read UtilityCostsType $utilityCostsType
 * @property-read ContractTermType $contractTermType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereCommonBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereContractTermTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereIsCoworking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereOperationalCostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock wherePriceMeterYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereRentBlockTaxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereRentContractTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RentBlock whereUtilityCostsTypeId($value)
 */
class RentBlock extends Model
{
    use AsSource;
    use AsSource;
    use Filterable;
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'common_block_id',
        'is_coworking',
        'price_meter_year_id',
        'operational_cost_id',
        'rent_block_tax_id',
        'rent_contract_type_id',
        'utility_costs_type_id',
        'contract_term_type_id',
        'deposit',
    ];

    public function commonBlock(): BelongsTo
    {
        return $this->belongsTo(CommonBlock::class, 'common_block_id');
    }

    public function priceMeterYear(): BelongsTo
    {
        return $this->belongsTo(Money::class, 'price_meter_year_id');
    }

    public function operationalCost(): BelongsTo
    {
        return $this->belongsTo(Money::class, 'operational_cost_id');
    }

    public function rentBlockTax(): BelongsTo
    {
        return $this->belongsTo(RentBlockTax::class, 'rent_block_tax_id');
    }

    public function rentContractType(): BelongsTo
    {
        return $this->belongsTo(RentContractType::class, 'rent_contract_type_id');
    }

    public function utilityCostsType(): BelongsTo
    {
        return $this->belongsTo(UtilityCostsType::class, 'utility_costs_type_id');
    }

    public function contractTermType(): BelongsTo
    {
        return $this->belongsTo(ContractTermType::class, 'contract_term_type_id');
    }
}
