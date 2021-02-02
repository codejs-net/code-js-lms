<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_category extends Model
{
    use HasFactory;
    protected $table="resource_categories";
    protected $fillable = ['category_si','category_ta','category_en'];

    // public function resource()
    // {
    //     return $this->belongsTo('App\Models\resource');
    // }
}
