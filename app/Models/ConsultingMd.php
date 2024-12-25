<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultingMd extends Model
{
    protected $table = 'consulting';
    protected $primaryKey ='id';
    protected $fillble = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}