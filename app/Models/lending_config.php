<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lending_config extends Model
{
    use HasFactory;
    protected $table="lending_configs";
    protected $fillable = ['categoryid','lending_limit','lending_period'];

    public function member_cat()
    {
        // return $this->hasone('App\Models\resource_category','category_id');
        return $this->belongsTo('App\Models\member_cat','categoryid');
    }
}
