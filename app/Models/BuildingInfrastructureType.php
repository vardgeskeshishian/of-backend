<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

/**
 * Class BuildingInfrastructure
 *
 * @package App\Models
 * @property int $id
 * @property int $building_id
 * @property int $infrastructure_type_id
 *
 * @property-read Building $building
 * @property-read InfrastructureType $infrastructureType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType whereBuildingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType whereInfrastructureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BuildingInfrastructureType whereUpdatedAt($value)
 */
class BuildingInfrastructureType extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    protected $table = 'building_infrastructure_type';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'building_id',
        'infrastructure_type_id',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    public function infrastructureType(): BelongsTo
    {
        return $this->belongsTo(InfrastructureType::class, 'infrastructure_type_id');
    }
}
