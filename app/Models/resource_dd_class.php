<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_dd_class extends Model
{
    use HasFactory;
    protected $table="resource_dd_classes";
    protected $fillable = ['class_code','class_si','class_ta','class_en'];

    // public function ddclass()
    // {
    //     // return $this->hasMany('App\Models\resource_dd_division');
    // }
}
