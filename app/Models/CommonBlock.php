<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Collection;

/**
 * @property int $id
 * @property int|null $building_id
 * @property string $name
 * @property bool $is_available
 * @property bool $is_negotiable_price
 * @property float $commission_amount_percent
 * @property bool $is_export_sites
 * @property bool $is_export_markets
 * @property bool $is_full_building
 * @property bool $is_floor_range
 * @property int|null $owner_id
 * @property int|null $min_area
 * @property int|null $max_area
 * @property int|null $useful_area
 * @property int|null $electric_power
 * @property int|null $max_parking_size
 * @property int|null $block_type_id
 * @property int|null $office_layout_type_id
 * @property int|null $office_readyness_type_id
 * @property int|null $is_for_vacation
 * @property bool $is_street_entrance
 * @property bool $is_separate_entrance
 * @property bool $is_furnished
 * @property string|null $inner_text
 * @property string|null $site_text
 * @property string|null $presentation_description
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommonBlock query()
 * @method static Builder|CommonBlock filters()
 * @property-read BlockType|null $blockType
 * @property-read Building|null $building
 * @property-read OfficeLayoutType|null $officeLayoutType
 * @property-read OfficeReadynessType|null $officeReadynessType
 * @property-read Money $minNegotiablePrice
 * @property-read User $owner
 * @property-read Collection<int, RentBlock> $rentBlocks
 * @property-read Collection<int, SaleBlock> $saleBlocks
 */
class CommonBlock extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'building_id',
        'name',
        'is_available',
        'is_negotiable_price',
        'commission_amount_percent',
        'is_export_sites',
        'is_export_markets',
        'is_full_building',
        'is_floor_range',
        'owner_id',
        'min_area',
        'max_area',
        'useful_area',
        'electric_power',
        'max_parking_size',
        'block_type_id',
        'office_layout_type_id',
        'office_readyness_type_id',
        'is_for_vacation',
        'is_street_entrance',
        'is_separate_entrance',
        'is_furnished',
        'inner_text',
        'site_text',
        'presentation_description',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function blockType(): BelongsTo
    {
        return $this->belongsTo(BlockType::class, 'block_type_id');
    }

    public function officeLayoutType(): BelongsTo
    {
        return $this->belongsTo(OfficeLayoutType::class, 'office_layout_type_id');
    }

    public function officeReadynessType(): BelongsTo
    {
        return $this->belongsTo(OfficeReadynessType::class, 'office_readyness_type_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function rentBlocks(): HasMany
    {
        return $this->hasMany(RentBlock::class);
    }
    public function saleBlocks(): HasMany
    {
        return $this->hasMany(SaleBlock::class);
    }

    public function blockImages(): HasMany
    {
        return $this->hasMany(CommonBlockImage::class);
    }
}
