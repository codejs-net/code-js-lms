<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class center_allocation extends Model
{
    use HasFactory;
    protected $table="center_allocations";
    protected $fillable = ['staff_id','center_id'];

  
    public function staff()
    {
        return $this->belongsTo('App\Models\staff','staff_id');
    }
    public function center()
    {
        return $this->belongsTo('App\Models\center','center_id');
    }
}
