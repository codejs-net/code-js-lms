<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class designetion extends Model
{
    use HasFactory;
    protected $table="designetions";
    protected $fillable = ['designetion_si','designetion_ta','designetion_en'];
}
