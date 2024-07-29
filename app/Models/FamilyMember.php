<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'building_id',
        'member_id',
        'name',
        'occupation',
        'age',
        'relation',
        'image',
        'created_date',
        'created_by'
    ];
}
