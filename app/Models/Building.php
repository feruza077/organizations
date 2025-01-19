<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Building extends Model
{
    use HasFactory;

    protected $fillable = ['address', 'coordinates'];

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

}
