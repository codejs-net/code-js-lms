<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_dd_section extends Model
{
    use HasFactory;
    protected $table="resource_dd_sections";
    protected $fillable = ['dd_class_id','dd_devision_id','section_code','section_si','section_ta','section_en'];

    // public function resource()
    // {
    //     return $this->belongsTo('App\Models\resource');
    // }
    public function dddevision()
    {
        return $this->belongsTo('App\Models\resource_dd_division','dd_devision_id');
    }
    public function ddclass()
    {
        return $this->belongsTo('App\Models\resource_dd_class','dd_class_id');
    }
}
