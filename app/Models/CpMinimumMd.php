<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpMinimumMd extends Model
{
    use HasFactory;
    protected $table = 'cp_minimum';
    protected $primaryKey = 'id';
    protected  $fillable = ['_id','minimum','created'];
    public $timestamps = false;
}
