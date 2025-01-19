<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationActivity extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = ['organization_id', 'activity_id'];

}
