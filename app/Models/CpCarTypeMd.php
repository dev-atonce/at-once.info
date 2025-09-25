<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpCarTypeMd extends Model
{
    use HasFactory;

    protected $table = 'cp_cartype';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','type','created'];
    public $timestamps = false;

}
