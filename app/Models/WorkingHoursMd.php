<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHoursMd extends Model
{
    protected $table = 'working_hours';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}