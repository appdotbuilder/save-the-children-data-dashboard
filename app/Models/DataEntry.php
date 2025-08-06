<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\DataEntry
 *
 * @property int $id
 * @property int $user_id
 * @property int $municipality_id
 * @property string $budget_headline
 * @property string $amount
 * @property int $fiscal_year
 * @property string $entry_date
 * @property array|null $tag_ids
 * @property array|null $sector_ids
 * @property array|null $category_ids
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Municipality $municipality
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereBudgetHeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereCategoryIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereEntryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereFiscalYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereMunicipalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereSectorIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereTagIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry forFiscalYear($year)
 * @method static \Illuminate\Database\Eloquent\Builder|DataEntry forMunicipality($municipalityId)
 * @method static \Database\Factories\DataEntryFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class DataEntry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'municipality_id',
        'budget_headline',
        'amount',
        'fiscal_year',
        'entry_date',
        'tag_ids',
        'sector_ids',
        'category_ids',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'entry_date' => 'date',
        'tag_ids' => 'array',
        'sector_ids' => 'array',
        'category_ids' => 'array',
    ];

    /**
     * Scope a query to filter by fiscal year.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForFiscalYear($query, $year)
    {
        return $query->where('fiscal_year', $year);
    }

    /**
     * Scope a query to filter by municipality.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  int  $municipalityId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForMunicipality($query, $municipalityId)
    {
        return $query->where('municipality_id', $municipalityId);
    }

    /**
     * Get the user that owns the data entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the municipality that owns the data entry.
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }
}