<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_rack extends Model
{
    use HasFactory;
    protected $table="resource_racks";
    protected $fillable = ['rack_si','rack_ta','rack_en'];
}
