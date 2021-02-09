<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_publisher extends Model
{
    use HasFactory;
    protected $table="resource_publishers";
    protected $fillable = ['publisher_si','publisher_ta','publisher_en'];

    // public function resource()
    // {
    //     return $this->belongsTo('App\Models\resource');
    // }
}
