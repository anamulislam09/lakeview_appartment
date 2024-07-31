<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'building_name',
        'building_location',
        'building_floor',
        'status',
        'created_date',
        'created_by'
    ];
}
