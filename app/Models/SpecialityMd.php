<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialityMd extends Model
{
    protected $table = 'speciality';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED = 'created';
    const UPDATED = 'updated';
}