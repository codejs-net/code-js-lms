<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table="members";
    protected $fillable = 
                    [
                    'titleid',
                    'categoryid',
                    'name_si',
                    'name_ta',
                    'name_en',
                    'address1_si',
                    'address1_ta',
                    'address1_en',
                    'address2_si',
                    'address2_ta',
                    'address2_en',
                    'nic',
                    'mobile',
                    'birthday',
                    'genderid',
                    'description',
                    'regdate',
                    'image',
                    'guarantor_id',
                    'status'
                    ];

}
