<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusMd extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
