<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'appartment_id',
        'building_id',
        'member_name',
        'guardian_name',
        'mother_name',
        'permanent_address',
        'date_of_birth',
        'nationality',
        'religion',
        'intercome_no',
        'land_phone',
        'mobile_phone',
        'email',
        'car_no',
        'nid_no',
        'nid',
        'image',
        'flat_reg_document',
        'garage_no',
        'occupation',
        'designation',
        'institute_name',
        'institute_address',
        'family_member_name',
        'family_member_occupation',
        'family_member_age',
        'family_member_relation',
        'family_member_image',
        'status',
        'created_date',
        'created_by',
    ];
}
