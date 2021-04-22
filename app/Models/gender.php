<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gender extends Model
{
    use HasFactory;
    protected $table="genders";
    protected $fillable = ['gender_si','gender_ta','gender_en'];

    // public function creator()
    // {
    //     return $this->belongsTo('App\Models\resource_creator','genderid');
    // }
    // public function guarantor()
    // {
    //     return $this->belongsTo('App\Models\member_guarantor','genderid');
    // }

    // public function donate()
    // {
    //     return $this->belongsTo('App\Models\resource_donate','genderid');
    // }

   
}
