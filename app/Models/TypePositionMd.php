<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePositionMd extends Model
{
    use HasFactory;
    protected $table = 'job_position';
    protected $primaryKey = 'id';
    protected $fillable = ['position_th','position_en','position_jp'];
    public $timestamps = true;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';

}
