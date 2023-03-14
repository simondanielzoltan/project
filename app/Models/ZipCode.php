<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZipCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'county',
        'zip_code',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function getCountyAttribute($county)
    {
        return $county . " vármegye";
    }

}
