<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_creator extends Model
{
    use HasFactory;
    protected $table="resource_creators";
    protected $fillable = 
                    [
                    'titleid',
                    'name_si',
                    'name_ta',
                    'name_en',
                    'address1_si',
                    'address1_ta',
                    'address1_en',
                    'address2_si',
                    'address2_ta',
                    'address2_en',
                    'mobile',
                    'genderid',
                    'description',
                    'image'
                    ];


    
}
