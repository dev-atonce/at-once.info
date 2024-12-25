<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class locateStMd extends Model
{
    use HasFactory;
    protected $table = 'st_locate';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company',
        'accuracy',
        'area_code',
        'ans',
        'city',
        'continent_code',
        'country',
        'country_code',
        'country_code3',
        'ip',
        'latitude',
        'longitude',
        'organization',
        'organization_name',
        'timezone',
    ];
    public $timestamps = false;
}
