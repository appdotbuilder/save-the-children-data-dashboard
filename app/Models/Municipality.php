<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Municipality
 *
 * @property int $id
 * @property string $name
 * @property string $name_nepali
 * @property string $type
 * @property string $district
 * @property string $district_nepali
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DataEntry> $dataEntries
 * @property-read int|null $data_entries_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereDistrictNepali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereNameNepali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality active()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality rural()
 * @method static \Illuminate\Database\Eloquent\Builder|Municipality urban()
 * @method static \Database\Factories\MunicipalityFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Municipality extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'name_nepali',
        'type',
        'district',
        'district_nepali',
        'status',
    ];

    /**
     * Scope a query to only include active municipalities.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include rural municipalities.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRural($query)
    {
        return $query->where('type', 'rural');
    }

    /**
     * Scope a query to only include urban municipalities.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUrban($query)
    {
        return $query->where('type', 'urban');
    }

    /**
     * Get the users for the municipality.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the data entries for the municipality.
     */
    public function dataEntries(): HasMany
    {
        return $this->hasMany(DataEntry::class);
    }
}