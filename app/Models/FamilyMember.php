<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'member_id',
        'family_member_name',
        'family_member_occupation',
        'family_member_age',
        'family_member_relation',
        'family_member_image'
    ];
}
