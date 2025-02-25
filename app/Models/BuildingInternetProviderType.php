<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class BuildingInternetProviderType
 *
 * @package App\Models
 * @property int $id
 * @property int $building_id
 * @property int $internet_provider_type_id
 *
 * @property-read Building $building
 * @property-read InternetProviderType $internetProviderType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType whereInternetProviderTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInternetProviderType whereUpdatedAt($value)
 */
class BuildingInternetProviderType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'building_internet_provider_type';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'building_id',
        'internet_provider_type_id',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    /**
     * Get the internet provider type associated with the BuildingInternetProviderType.
     */
    public function internetProviderType(): BelongsTo
    {
        return $this->belongsTo(InternetProviderType::class, 'internet_provider_type_id');
    }
}
