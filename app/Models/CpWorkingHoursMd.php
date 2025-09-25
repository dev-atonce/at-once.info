<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpWorkingHoursMd extends Model
{
    protected $table = 'cp_working_hours';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','day','time','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = false;
}