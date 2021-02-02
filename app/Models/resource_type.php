<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_type extends Model
{
    use HasFactory;
    protected $table="resource_types";
    protected $fillable = ['category_id','type_si','type_ta','type_en'];

    public function resource()
    {
        return $this->belongsTo('App\Models\resource');
    }

    public function category()
    {
        // return $this->hasone('App\Models\resource_category','category_id');
        return $this->belongsTo('App\Models\resource_category');
    }
    
}
