<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;
    protected $table="titles";
    protected $fillable = ['title_si','title_ta','title_en'];
}
