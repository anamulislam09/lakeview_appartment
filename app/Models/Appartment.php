<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartment extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'building_id',
        'appartment_name',
        'location',
        'status',
        'created_date',
        'created_by'
    ];
}
