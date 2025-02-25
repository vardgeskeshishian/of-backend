<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Building
 *
 * @package App\Models
 * @property int $id
 * @property string|null $name
 * @property string|null $eng_name
 * @property int $gross_boma_area
 * @property int $gross_leasable_area
 * @property int $land_area
 * @property int $floors_count
 * @property int|null $build_year
 * @property int|null $freight_elevators
 * @property string $address
 * @property array $coordinates
 * @property int|null $passenger_elevators
 * @property string|null $taxes_department_number
 * @property int|null $assignment_id
 * @property int|null $class_code_id
 * @property int|null $provider_id
 * @property int|null $conditioning_id
 * @property int|null $fire_alarm_id
 * @property int|null $security_id
 * @property int|null $ventilation_id
 * @property bool $parking_coefficient_is_unlimited
 * @property int|null $coefficient_first_value
 * @property int|null $coefficient_last_value
 * @property bool $was_moderated
 * @property bool $is_export_sites
 * @property bool $is_new_construction
 * @property int|null $commissioning_year
 * @property int|null $commissioning_quarter
 * @property string|null $cadastral_number
 * @property string|null $cadastral_land_number
 * @property Carbon|null $land_contract_date
 * @property int|null $district_type_id
 * @property int|null $operating_costs_without_nds
 * @property int|null $year_reconstruction
 * @property int $is_object_cultural_heritage
 * @property string|null $ensemble_name
 * @property int|null $built_up_area
 * @property int|null $underground_floors_count
 * @property string|null $permitted_use_of_land_plot
 * @property int $administrative_district_type_id
 * @property int $exterior_wall_type_id
 * @property int $overlap_type_id
 * @property int $law_type_id
 *
 * @property-read Assignment|null $assignment
 * @property-read ClassCode|null $classCode
 * @property-read Conditioning|null $conditioning
 * @property-read FireAlarm|null $fireAlarm
 * @property-read Provider|null $provider
 * @property-read Security|null $security
 * @property-read Ventilation|null $ventilation
 * @property-read DistrictType|null $districtType
 * @property-read AdministrativeDistrictType $administrativeDistrictType
 * @property-read ExteriorWallType $exteriorWallType
 * @property-read OverlapType $overlapType
 * @property-read LawType $lawType
 * @property-read Collection<int, CommonBlock> $commonBlocks
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Building newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Building query()
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereAddressFull($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereAddressJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereAssignmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereBuildYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereClassCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCadastralLandNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCadastralNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereConditioningId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCoefficientFirstValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCoefficientLastValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCommissioningQuarter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereCommissioningYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereFreightElevators($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereGrossBomaArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereGrossLeasableArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereInnerComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereIsExportMarkets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereIsExportSites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereLandArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereLandContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereOperatingCostsWithoutNds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereOuterComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereParkingCoefficientIsUnlimited($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building wherePassageElevators($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building wherePresentationDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereSecurityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereVentilationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Building whereWasModerated($value)
 * @method static Builder|Building filters()
 *
 */
class Building extends Model
{
    use HasFactory;
    use AsSource;
    use Filterable;

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'eng_name',
        'gross_boma_area',
        'gross_leasable_area',
        'land_area',
        'floors_count',
        'build_year',
        'freight_elevators',
        'passenger_elevators',
        'taxes_department_number',
        'outer_comment',
        'assignment_id',
        'class_code_id',
        'provider_id',
        'conditioning_id',
        'fire_alarm_id',
        'security_id',
        'ventilation_id',
        'parking_coefficient_is_unlimited',
        'coefficient_first_value',
        'coefficient_last_value',
        'was_moderated',
        'is_export_sites',
        'is_new_construction',
        'commissioning_year',
        'commissioning_quarter',
        'cadastral_number',
        'cadastral_land_number',
        'land_contract_date',
        'district_type_id',
        'operating_costs_without_nds',
        'year_reconstruction',
        'is_object_cultural_heritage',
        'ensemble_name',
        'built_up_area',
        'underground_floors_count',
        'permitted_use_of_land_plot',
        'administrative_district_type_id',
        'exterior_wall_type_id',
        'overlap_type_id',
        'law_type_id',
        'address',
        'coordinates',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'gross_boma_area' => 'integer',
        'gross_leasable_area' => 'integer',
        'land_area' => 'integer',
        'floors_count' => 'integer',
        'build_year' => 'integer',
        'freight_elevators' => 'integer',
        'passenger_elevators' => 'integer',
        'parking_coefficient_is_unlimited' => 'boolean',
        'coefficient_first_value' => 'integer',
        'coefficient_last_value' => 'integer',
        'was_moderated' => 'boolean',
        'is_export_sites' => 'boolean',
        'is_new_construction' => 'boolean',
        'commissioning_year' => 'integer',
        'commissioning_quarter' => 'integer',
        'land_contract_date' => 'date',
        'coordinates' => 'array',
    ];

    protected array $allowedFilters = [
        'name' => Like::class,
    ];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function classCode(): BelongsTo
    {
        return $this->belongsTo(ClassCode::class, 'class_code_id');
    }

    public function conditioning(): BelongsTo
    {
        return $this->belongsTo(Conditioning::class, 'conditioning_id');
    }

    public function fireAlarm(): BelongsTo
    {
        return $this->belongsTo(FireAlarm::class, 'fire_alarm_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function security(): BelongsTo
    {
        return $this->belongsTo(Security::class, 'security_id');
    }

    public function ventilation(): BelongsTo
    {
        return $this->belongsTo(Ventilation::class, 'ventilation_id');
    }

    public function districtType(): BelongsTo
    {
        return $this->belongsTo(DistrictType::class, 'district_type_id');
    }

    public function administrativeDistrictType(): BelongsTo
    {
        return $this->belongsTo(AdministrativeDistrictType::class, 'administrative_district_type_id');
    }

    public function exteriorWallType(): BelongsTo
    {
        return $this->belongsTo(ExteriorWallType::class);
    }

    public function overlapType(): BelongsTo
    {
        return $this->belongsTo(OverlapType::class, 'overlap_type_id');
    }

    public function lawType(): BelongsTo
    {
        return $this->belongsTo(LawType::class, 'law_type_id');
    }

    public function commonBlocks(): HasMany
    {
        return $this->hasMany(CommonBlock::class);
    }

    public function metros(): BelongsToMany
    {
        return $this->belongsToMany(Metro::class, 'building_metro')
            ->withPivot('time_foot', 'time_car');
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(
            Image::class,
            'building_image',
            'building_id',
            'image_id',
            'id',
            'id',
        )->withPivot('type', 'sort_order');
    }
}
