<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class resource_creator extends Model
{
    use HasFactory, LogsActivity;
    protected $table="resource_creators";
    protected $fillable = 
                    [
                    'titleid',
                    'name_si',
                    'name_ta',
                    'name_en',
                    'address1_si',
                    'address1_ta',
                    'address1_en',
                    'address2_si',
                    'address2_ta',
                    'address2_en',
                    'mobile',
                    'genderid',
                    'description',
                    'image'
                    ];

// protected static $logAttributes = ['name_si', 'address1_si'];
protected static $logFillable = true;
// protected static $logUnguarded = true;
protected static $logOnlyDirty = true;
protected static $submitEmptyLogs = false;
protected static $logName = 'resource_creator';
    
}
