<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackingMd extends Model
{
    protected $table = 'packing';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','packing','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}