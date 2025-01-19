<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $fillable = ['name', 'parent_id'];

    protected $hidden = ['pivot'];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($activity) {
            if ($activity->getDepth() >= 3) {
                throw new \Exception("Невозможно добавить деятельность, превышен максимальный уровень вложенности.");
            }
        });
    }

    public function parent()
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_activities');
    }

    public function getDepth($depth = 0)
    {
        if ($this->parent) {
            return $this->parent->getDepth($depth + 1);
        }
        return $depth;
    }

}
