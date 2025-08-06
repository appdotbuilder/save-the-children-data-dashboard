<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sector
 *
 * @property int $id
 * @property string $title
 * @property string $title_nepali
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereTitleNepali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sector active()
 * @method static \Database\Factories\SectorFactory factory(...$parameters)
 * 
 * @mixin \Eloquent
 */
class Sector extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'title_nepali',
        'status',
    ];

    /**
     * Scope a query to only include active sectors.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}