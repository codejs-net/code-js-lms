<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_language extends Model
{
    use HasFactory;
    protected $table="resource_languages";
    protected $fillable = ['language_si','language_ta','language_en'];

    public function resource()
    {
        return $this->belongsTo('App\Models\resource');
    }
}
