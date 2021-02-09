<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource extends Model
{
    use HasFactory;
    protected $table="resources";
    protected $fillable = [
        'accessionNo', 
        'standard_number', 
        'title_si', 
        'title_ta', 
        'title_en',
        'cretor_id',
        'category_id',
        'type_id',
        'dd_class_id',
        'dd_devision_id',
        'dd_section_id',
        'ddc',
        'center_id',
        'language_id',
        'publisher_id',
        'purchase_date',
        'edition',
        'price',
        'publishyear',
        'phydetails',
        'note_si',
        'note_ta',
        'note_en',
        'status',
        'br_qr_code',
        'image'
    ];
    

    // public function category()
    // {
    //     return $this->hasMany('App\Models\resource_category','category_id');
    // }
}
