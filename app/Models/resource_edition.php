<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class resource_edition extends Model
{
    use HasFactory;

    public function resource()
    {
        return $this->belongsTo('App\Models\resource');
    }
}
