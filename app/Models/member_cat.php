<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member_cat extends Model
{
    use HasFactory;
    protected $table="member_cats";
    protected $fillable = ['category_si','category_ta','category_en'];
}
