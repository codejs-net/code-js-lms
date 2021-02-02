<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class library extends Model
{
    use HasFactory;
    protected $table="libraries";
    protected $fillable = ['name_si', 'name_ta', 'name_en', 'address1_si', 'address1_ta','address1_en','address2_si','address2_ta','address2_en','telephone','fax','email','description'];
}

