<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'building_id', 'phone_numbers'];

    protected $casts = [
        'phone_numbers' => 'json',
    ];

    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'organization_activities');
    }
    
}
