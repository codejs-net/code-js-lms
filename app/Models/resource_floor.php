<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_floor extends Model
{
    use HasFactory;
    protected $table="resource_floors";
    protected $fillable = ['rack_id','floor_si','floor_ta','floor_en'];

    public function rack()
    {
        return $this->belongsTo('App\Models\resource_rack','rack_id');
    }
}
