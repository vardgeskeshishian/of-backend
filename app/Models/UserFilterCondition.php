<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserFilterCondition
 *
 * @package App\Models
 * @property int $id
 *
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserFilterCondition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFilterCondition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFilterCondition query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFilterCondition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFilterCondition whereUser($value)
 */
class UserFilterCondition extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'user_filter_condition';

    public $timestamps = false;
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'user',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'user' => 'integer',
    ];

    /**
     * Get the user that owns the UserFilterCondition.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }
}
