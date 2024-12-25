<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProvinceMd extends Model
{
    protected $table = 'provinces';
    protected $primaryKey = 'province_id';
    protected $fillable = ['province_id','code','province_name_th','province_name_en','area','geography_id'];
    public $timestamp = false;
}
