<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_placement extends Model
{
    use HasFactory;
    protected $table="resource_placements";
    protected $fillable = ['resource_id','rack_id','floor_id','placement_index'];
}
