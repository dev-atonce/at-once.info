<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportMd extends Model
{
    protected $table = 'transport';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name_jp','name_th','created','updated'];
    public $timestamps = true;
    const CREATED = 'created';
    const UPDATED = 'updated';
}