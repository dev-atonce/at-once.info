<?php

namespace App\Models\Filter;

use Illuminate\Database\Eloquent\Model;

class CpPackagingMd extends Model
{
    protected $table = 'cp_packaging';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','packaging','created','updated'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}