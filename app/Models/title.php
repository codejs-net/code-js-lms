<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;
    protected $table="titles";
    protected $fillable = ['title_si','title_ta','title_en'];

    public function creator()
    {
        return $this->belongsTo('App\Models\resource_creator','titleid');
    }
    public function guarantor()
    {
        return $this->belongsTo('App\Models\member_guarantor','titleid');
    }

    public function donate()
    {
        return $this->belongsTo('App\Models\resource_donate','titleid');
    }

    public function survey_board()
    {
        return $this->belongsTo('App\Models\survey_board','titleid');
    }
}
