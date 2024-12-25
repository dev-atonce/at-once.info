<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubdistrictMd extends Model
{
    protected $table = 'sub-district';
    protected $primaryKey = 'subdist_id';
    protected $fillable = ['subdist_id','postcode','subdist_name_th','subdist_name_en','district_id'];
    public $timestamps = false;
}