<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CpSoftwareMd extends Model
{
    use HasFactory;
    protected $table = 'cp_software';
    protected $primaryKey = 'id';
    protected $fillable = ['id','_id','software','created'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'updated';
    public $timestamps = true;
}
