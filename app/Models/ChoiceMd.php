<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChoiceMd extends Model
{
    protected $table = 'choice';
    protected $primaryKey = 'id';
    protected $fillable = ['id','type','key','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}