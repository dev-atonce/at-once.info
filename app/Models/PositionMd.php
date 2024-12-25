<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionMd extends Model
{
    use HasFactory;
    protected $table = 'job_position_sub';
    protected $primaryKey = 'id';
    protected $fillable = ['position_th','position_en','position_jp'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
}
