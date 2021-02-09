<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_dd_division extends Model
{
    use HasFactory;
    protected $table="resource_dd_divisions";
    protected $fillable = ['dd_class_id','devision_code','devision_si','devision_ta','devision_en'];

    // public function resource()
    // {
    //     return $this->belongsTo('App\Models\resource');
    // }
    public function ddecimal()
    {
        return $this->belongsTo('App\Models\resource_dd_class','dd_class_id');
    }
}
