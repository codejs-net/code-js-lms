<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $fillable = ['title', 'Categoryid', 'name_si', 'name_ta', 'name_en','address1_si','address1_ta','address1_en','address2_si','address2_ta','address2_en','designetion_id','nic','mobile','birthday','gender','description','regdate'];

    public function user()
    {
        return $this->hasone('App\Models\user','staff_id');
    }
}
